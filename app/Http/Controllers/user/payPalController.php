<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Session;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Events\UserOrderEvent;


use App\Models\Information;
use App\Models\admin\ValueAttribute;

use Illuminate\Support\Facades\DB;
use Exception;
class payPalController extends Controller
{
    public function payment(Request $request){

        if ($request->isMethod('Post')) {
            $rules = [
                'color' => 'required',
                'size' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        if(Session::has('payment')){
            session()->forget('payment');
        }
        $product = Product::find($request->product_id);
        $payment = collect(session('payment'),[]);
        $payment = $payment->toArray();
        array_push($payment,[
            'product' => Product::find($request->product_id),
            'quantity' => $request->stock,
            'size' => ValueAttribute::find($request->size)->value,
            'color' => ValueAttribute::find($request->color)->value,
            'image' => Product::find($request->product_id)->images->first()->path,
            'voucher' => $request->voucher,
        ]);
        session()->put('payment', $payment); 
        $payments = session()->get('payment',[]);
        return view('user.design.payment',compact('brands','products','categories','cart','payments','product'));                
    }
    
    public function voucher($voucher){
       
        $payment = collect(session('payment'),[]);
        $payment = $payment->toArray();
        $payment[0]['voucher'] = $voucher;
        session()->put('payment',$payment);
        return response()->json([
            'result' => $payment,
        ]);
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {

        if ($request->isMethod('POST')) {
            $rules = [
                'fullname' => 'required|max:255',
                'phone' => 'required|max:10',
                'address' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'max' => 'Đã vượt qua số từ cho phép',
            ];
            $request->validate($rules, $messages);
        }
        if(Session::has('order')){
            session()->forget('order');
        }

        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        $paymentCollect = collect(session('payment',[]));
        foreach($paymentCollect as $payment){
            $product = Product::find($payment['product']->id);
        }
        $total_money = $paymentCollect->sum(function($cartItem){
            if (!$cartItem['product']->discount) {
                 $subTotal = $cartItem['quantity'] * $cartItem['product']->price;
            } else {
                 $subTotal= $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
            }
            switch($cartItem['voucher']){
                case(!($cartItem['voucher'])):
                  return $subTotal + ($subTotal * 0.1) + (15000 * count(collect('payment',[])));
                  break;
                case($cartItem['voucher'] == 0):
                    return $subTotal + ($subTotal * 0.1) + (15000 * count(collect('payment',[])));
                    break;
                case($cartItem['voucher'] > 0 && $cartItem['voucher'] <= 100):
                    return $subTotal + ($subTotal * 0.1) + (15000 * count(collect('payment',[]))) - ($subTotal * ($cartItem['voucher']/100));
                    break;
                case($cartItem['voucher'] >100):
                    return $subTotal + ($subTotal * 0.1) + (15000 * count(collect('payment',[]))) - ($cartItem['voucher']);
                    break;
            }
        });
        $order = collect(session('order',[]));
        $order = $order->toArray();
        
        foreach($paymentCollect as $payment){
            array_push($order,[
              'product' => $payment['product'],
              'quantity' => $payment['quantity'],
              'size' => $payment['size'],
              'color' => $payment['color'],
              'image' => $payment['image'],
              'voucher' => $request->voucher,
              'user_id' => $request->user_id,
              'phone' => $request->phone,
              'address' => $request->address,
              'subtotal' => $request->subtotal,
              'fullname' => $request->fullname,
              'total' => $total_money,
              'note' => $request->note,
            ]);
        }

        session()->put('order',$order);
        $finalTotal = round(($total_money / 22180),2);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1",
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return view('user.design.payment',compact('brands','products','categories','cart','payments','product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');  

        } else {
            return view('user.design.payment',compact('brands','products','categories','cart','payments','product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');  
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            $orders = session()->get('order', []);
        
            try{
                DB::beginTransaction();
                foreach($orders as $order){
                    $orderCreate = Order::create([
                        'user_id' => $order['user_id'],
                        'fullname' => $order['fullname'],
                        'phone' => $order['phone'],
                        'address' => $order['address'],
                        'note' => $order['note'],
                        'subtotal' => $order['subtotal'],
                        'total_money' => $order['total'],
                    ]);
                 
                }

                $orderCollect = collect($orders);
                $orderCollect->each(function ($cartItem) use ($orderCreate) {
                    OrderDetail::create([
                        'order_id' => $orderCreate->id,
                        'product_id' => $cartItem['product']->id,
                        'quantity' => $cartItem['quantity'],
                        'name' => $cartItem['product']->name,
                        'size' => $cartItem['size'],
                        'color' => $cartItem['color'],
                        'sale' => $cartItem['product']->sale,
                        'discount' => $cartItem['product']->discount,
                        'price' => $cartItem['product']->price,
                        'total_money' => $cartItem['total'],
                    ]);
                    Product::where('id', $cartItem['product']->id)->update([
                        'sold'=> $cartItem['product']->sold + $cartItem['quantity'],
                        'stock' => $cartItem['product']->stock - $cartItem['quantity'],
                    ]);
                });
                $count =OrderDetail::where('status', 0)->count();
                $name = $orders[0]['fullname'];
                event(new UserOrderEvent($name,$count));
                DB::commit();
            }catch(Exception $e){
                DB::rollBack();
                return back()->with('error','Đã xảy ra lỗi về thanh toán');
            };
            
          
            
            session()->forget('payment');
            session()->forget('order');
    
            return redirect()
                ->route('history')
                ->with('success', 'Thanh toán thành công');
        } else {
            return redirect()
                ->back()
                ->with('error', $response['message'] ?? 'Đã xảy ra lỗi');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        $payments = session()->get('payment',[]);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        foreach($payments as $payment){
            $product = Product::find($payment['product']->id);
        }
        return view('user.design.payment',compact('brands','products','categories','cart','payments','product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');  
    }

    public function history(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.history',compact('brands','products','categories','cart'))->with('success','Đã thanh toán thành công');        
    }

    public function softdelete($id){
        $orderDetail = OrderDetail::find($id);
        try{
                $products = Product::where('id' , $orderDetail->product_id)->get();
                foreach($products as $product){
                    $product->sold = $product->sold - $orderDetail->quantity;
                    $product->stock = $product->stock + $orderDetail->quantity;
                    $product->save();
                }
                $orderDetail->delete();
            return redirect()->back()->with('success', 'Đã hủy đơn hàng');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }
    public function restore($id){
       $orderDetail = OrderDetail::onlyTrashed()->find($id);
         try{
                $products = Product::where('id' , $orderDetail->product_id)->get();
                foreach($products as $product){
                    if($product->stock == 0){
                        return redirect()->back()->with('error', 'Sản phẩm này đã hết hàng');
                    }else{
                        $product->sold = $product->sold + $orderDetail->quantity;
                        $product->stock = $product->stock - $orderDetail->quantity;
                        $product->save();
                    }
                $orderDetail->restore();
            }
       
            return redirect()->back()->with('success', 'Đã đặt lại đơn hàng');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }  
}
