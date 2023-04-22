<?php

namespace App\Http\Controllers\user;
use App\Models\admin\Product;
use App\Http\Controllers\Controller;
use App\Models\admin\ValueAttribute;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Events\UserOrderEvent;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpParser\ErrorHandler\Collecting;

class cartController extends Controller
{

    public function viewCart(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.cart',compact('brands','products','categories','cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $cart = collect(session('cart', []));
        $foundIndex = $cart->search(function ($item, $index) use ($id) {
            return $item['product']->id == $id;
        });
        $cart = $cart->toArray();
        if ($foundIndex !== false && $foundIndex >= 0) {
            $cart[$foundIndex]['quantity'] += ($request->quantity);
        } else {
            array_push($cart, [
                'product' => Product::find($id),
                'quantity' => $request->quantity,
                'size' => ValueAttribute::find($request->size)->value,
                'color' => ValueAttribute::find($request->color)->value,
                'image' => Product::find($id)->images->first()->path,
            ]);
        }
        session()->put('cart', $cart);
        return response()->json([
            'cart'=>$cart,
        ]);
    }

    public function removeCart($id){        
        $cart = collect(session('cart', []));
        $tmpCart = $cart->filter(function ($item) use ($id) {
            return $item['product']->id != $id;
        })->values();
        session()->put('cart', $tmpCart->toArray());        
        return response()->json([
            'cart'=>$tmpCart,
        ]);
    }

    public function updateQuantity($id ,$quantity){
        $cart = collect(session('cart', []));
        $foundIndex = $cart->search(function ($item, $index) use ($id) {
            return $item['product']->id == $id;
        });
        $cart = $cart->toArray();

        if ($foundIndex !== false && $foundIndex >= 0 && $quantity > 0) {
            $cart[$foundIndex]['quantity'] = $quantity;
        }

        session()->put('cart', $cart);


        return response()->json([
            'status' => 'success',
            'data' => $cart,
            'cart_item' => $cart[$foundIndex]
        ]);
    }

    public function deleteCart($id){
        $tmpCart = collect(session('cart', []));
        $cart = $tmpCart->filter(function ($item) use ($id) {
            return $item['product']->id != $id;
        })->values();
        session()->put('cart', $cart->toArray()); 
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.design.cart',compact('cart','brands','products','categories'));
    }

    public function checkout(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        
        return view('user.design.checkout',compact('brands','products','categories','cart'));                
    }

    public function process(Request $request){
        

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

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $cartCollect = collect(session('cart',[]));
        $subTotal = $cartCollect->sum(function ($cartItem) {
            if (!$cartItem['product']->discount) {
                return $cartItem['quantity'] * $cartItem['product']->price;
            } else {
                return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
            }
        });
        $totalMoney = $subTotal + ($subTotal * 0.1) + (15000 * count($cartCollect));
        $order = collect(session('order',[]));
        $order = $order->toArray();

        foreach($cartCollect as $cartItem){
            array_push($order,[
              'product' => $cartItem['product'],
              'quantity' => $cartItem['quantity'],
              'size' => $cartItem['size'],
              'color' => $cartItem['color'],
              'image' => $cartItem['image'],
              'voucher' => $request->voucher,
              'user_id' => $request->user_id,
              'phone' => $request->phone,
              'address' => $request->address,
              'subtotal' => $request->subtotal,
              'fullname' => $request->fullname,
              'total' => $totalMoney,
              'note' => $request->note,
            ]);
        }

        session()->put('order',$order);
        $finalTotal = round(($totalMoney / 22180),2);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel'),
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

            return redirect()
                ->route('checkout' )
                ->with('error', 'Đã xảy ra lỗi');

        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Đã xảy ra lỗi');
        }
    }

     /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            $orders = session()->get('order', []);
           
            try{
                DB::beginTransaction();
                            $orderCreate = Order::create([
                            'user_id' => $orders[0]['user_id'],
                            'fullname' => $orders[0]['fullname'],
                            'phone' => $orders[0]['phone'],
                            'address' => $orders[0]['address'],
                            'note' => $orders[0]['note'],
                            'subtotal' => $orders[0]['subtotal'],
                            'total_money' => $orders[0]['total'],
                        ]);

                $orderCollect = collect($orders);
                $orderCollect->each(function ($cartItem) use ($orderCreate) {
                    if (!$cartItem['product']->discount) {
                        $totalMoney = $cartItem['quantity'] * $cartItem['product']->price;
                    } else {
                        $totalMoney = $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                    }
                    $finalTotal = $totalMoney + ($totalMoney * 0.1) + 15000;  
                    OrderDetail::create([
                        'order_id' => $orderCreate->id,
                        'product_id' => $cartItem['product']->id,
                        'quantity' => $cartItem['quantity'],
                        'name' => $cartItem['product']->name,
                        'size' => $cartItem['size'],
                        'color' => $cartItem['color'],
                        'price' => $cartItem['product']->price,
                        'sale' => $cartItem['product']->sale,
                        'discount' => $cartItem['product']->discount,
                        'total_money' => $finalTotal,
                    ]);

                    Product::where('id', $cartItem['product']->id)->update([
                        'sold'=> $cartItem['product']->sold + $cartItem['quantity'],
                        'stock' => $cartItem['product']->stock - $cartItem['quantity'],
                    ]);
                });

                DB::commit();
            }catch(Exception $e){
                DB::rollBack();
                return back()->with('error','Đã xảy ra lỗi về thanh toán');
            };

            $count =OrderDetail::where('status', 0)->count();
            $name = $orders[0]['fullname'];
            event(new UserOrderEvent($name,$count));
            session()->forget('cart');
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
    public function cancel(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.checkout',compact('brands','products','categories','cart'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');  
    }
}
