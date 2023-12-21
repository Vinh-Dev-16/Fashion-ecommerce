<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\FeedBack;
use App\Models\ImageFeedBack;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
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
    public function payment(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
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
        if (Session::has('payment')) {
            session()->forget('payment');
        }
        $product = Product::find($request->product_id);
        $payment = collect(session('payment'), []);
        $payment = $payment->toArray();
        $payment[] = [
            'product' => Product::find($request->product_id),
            'quantity' => $request->stock,
            'size' => ValueAttribute::find($request->size)->value,
            'color' => ValueAttribute::find($request->color)->value,
            'image' => Product::find($request->product_id)->images->first()->path,
            'voucher' => $request->voucher,
        ];
        session()->put('payment', $payment);
        $payments = session()->get('payment', []);
        return view('user.design.payment.index', compact('brands', 'products', 'categories', 'cart', 'payments', 'product'));
    }

    public function voucher(Request $request): \Illuminate\Http\JsonResponse
    {

        $payment = collect(session('payment'), []);
        $payment = $payment->toArray();
        $payment[0]['voucher'] = $request->voucher;
        session()->put('payment', $payment);
        return response()->json([
            'result' => $payment,
        ]);
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws \Throwable
     * @throws NotFoundExceptionInterface
     */
    public function processTransaction(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
        if (Session::has('order')) {
            session()->forget('order');
        }

        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $paymentCollect = collect(session('payment', []));
        foreach ($paymentCollect as $payment) {
            $product = Product::find($payment['product']->id);
        }
        $total_money = $paymentCollect->sum(function ($cartItem) {
            if (!$cartItem['product']->discount) {
                $subTotal = $cartItem['quantity'] * $cartItem['product']->price;
            } else {
                $subTotal = $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
            }
            switch ($cartItem['voucher']) {
                case ($cartItem['voucher'] == 0):
                case(!($cartItem['voucher'])):
                    return $subTotal + ($subTotal * 0.1) ;
                    break;
                case($cartItem['voucher'] > 0 && $cartItem['voucher'] <= 100):
                    return $subTotal + ($subTotal * 0.1)  - ($subTotal * ($cartItem['voucher'] / 100));
                    break;
                case($cartItem['voucher'] > 100):
                    return $subTotal + ($subTotal * 0.1) - ($cartItem['voucher']);
                    break;
            }
        });
        $total_money = $total_money + $request->fee;
        $order = collect(session('order', []));
        $order = $order->toArray();

        foreach ($paymentCollect as $payment) {
            $order[] = [
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
            ];
        }

        session()->put('order', $order);
        $finalTotal = round(($total_money / 22180), 2);
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

            return view('user.design.payment.index', compact('brands', 'products', 'categories', 'cart', 'product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');

        } else {
            return view('user.design.payment.index', compact('brands', 'products', 'categories', 'cart', 'product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');
        }
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws \Throwable
     * @throws NotFoundExceptionInterface
     */
    public function successTransaction(Request $request): \Illuminate\Http\RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $orders = session()->get('order', []);

            try {
                DB::beginTransaction();
                foreach ($orders as $order) {
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
                        'sold' => $cartItem['product']->sold + $cartItem['quantity'],
                        'stock' => $cartItem['product']->stock - $cartItem['quantity'],
                    ]);
                });
                $count = OrderDetail::where('status', 0)->count();
                $name = $orders[0]['fullname'];
                event(new UserOrderEvent($name, $count));
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Đã xảy ra lỗi về thanh toán');
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


    public function cancelTransaction(Request $request)
    {
        $payments = session()->get('payment', []);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        foreach ($payments as $payment) {
            $product = Product::find($payment['product']->id);
        }
        return view('user.design.payment.index', compact('brands', 'products', 'categories', 'cart', 'payments', 'product'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');
    }

    public function history()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $user = Auth::user()->with('information')->first();
        return view('user.design.history.index', compact('user','brands', 'products', 'categories', 'cart'))->with('success', 'Đã thanh toán thành công');
    }

    public function print(Request $request): string
    {
        $id = $request->id;
        $orderDetail = OrderDetail::where('id', $id)->first();
        $user = Auth::user()->with('information')->first();
        return view('user.design.history.print', compact('user','orderDetail'))->render();
    }

    public function printInvoice(Request $request): \Illuminate\Http\Response
    {
        $pdf = PDF::loadview('user.design.history.invoice');
        return $pdf->download('Fashion_Invoice.pdf');
    }

    public function createFeedback(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $rate = $product->feedbacks()->pluck('feedbacks.rate')->avg();
        $count = $product->feedbacks()->count();
        return [
            'status' => 1,
            'view' => view('user.design.history.create_feedback', compact('product', 'rate', 'count'))->render(),
        ];
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'rate' => 'required',
        ], [
            'title.required' => 'Không được để trống tiêu đề',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'content.required' => 'Không được để trống nội dung',
            'rate.required' => 'Không được để trống đánh giá',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ];
        }
        try {
            $input = $request->all();
            $newFeedback = FeedBack::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'title' => $input['title'],
                'content' => $input['content'],
                'product_id' => $input['product_id'],
                'rate' => $input['rate'],
            ]);
            if ($request->images) {
                $files = $request->images;
                foreach ($files as $file) {
                    ImageFeedBack::create([
                        'path' => $file,
                        'feedback_id' => $newFeedback->id,
                    ]);
                }
            }
            $count = FeedBack::where('product_id', $input['product_id'])->count();
            $rateStar = FeedBack::where('product_id', $input['product_id'])->pluck('rate')->avg();
            $rate = round($rateStar, 1);
            Product::where('id', $input['product_id'])->update([
                'rate' => $rate,
                'count' => $count,
            ]);
            $product = Product::findOrFail($request->product_id);
            return [
                'status' => 1,
                'message' => 'Gửi đánh giá thành công',
                'count' => $count,
                'rate' => $rate,
                'html' => view('user.design.detail.rating', compact('product', 'rate', 'count'))->render(),
                'view' => view('user.design.detail.feedback', compact('count', 'rate', 'product'))->render(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
            ];
        }
    }

    public function loadImages(): array
    {
        try {
            return [
                'status' => 1,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 0,
                'message' => 'Đã xảy ra lỗi',
            ];
        }
    }

    public function softDelete($id): \Illuminate\Http\RedirectResponse
    {
        $orderDetail = OrderDetail::find($id);
        try {
            $products = Product::where('id', $orderDetail->product_id)->get();
            foreach ($products as $product) {
                $product->sold = $product->sold - $orderDetail->quantity;
                $product->stock = $product->stock + $orderDetail->quantity;
                $product->save();
            }
            $orderDetail->delete();
            return redirect()->back()->with('success', 'Đã hủy đơn hàng');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function restore($id)
    {
        $orderDetail = OrderDetail::onlyTrashed()->find($id);
        try {
            $products = Product::where('id', $orderDetail->product_id)->get();
            foreach ($products as $product) {
                if ($product->stock == 0) {
                    return redirect()->back()->with('error', 'Sản phẩm này đã hết hàng');
                } else {
                    $product->sold = $product->sold + $orderDetail->quantity;
                    $product->stock = $product->stock - $orderDetail->quantity;
                    $product->save();
                }
                $orderDetail->restore();
            }

            return redirect()->back()->with('success', 'Đã đặt lại đơn hàng');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }
}
