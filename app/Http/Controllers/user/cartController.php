<?php

namespace App\Http\Controllers\user;

use App\Models\admin\Product;
use App\Http\Controllers\Controller;
use App\Models\admin\ValueAttribute;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
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


    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function viewCart(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cart = session()->get('cart', []);
        if (session()->has('selectedCart') && session()->get('selectedCart') != null) {
            $selectedCart = session()->get('selectedCart', []);
            return view('user.design.view_cart.index', compact('cart', 'selectedCart'));
        }
        return view('user.design.view_cart.index', compact('cart'));
    }

    public function addToCart(Request $request): array
    {
        $product_id = $request->product_id;
        $size = $request->size;
        $color = $request->color;
        $sizeName = ValueAttribute::find($size)->value;
        $colorName = ValueAttribute::find($color)->value;
        $cart = collect(session('cart', []));
        $foundIndex = $cart->search(function ($item, $index) use ($product_id, $sizeName, $colorName) {
            if ($item['product']->id == $product_id) {
                return $item['size'] == $sizeName && $item['color'] == $colorName;
            }
            return false;
        });
        $cart = $cart->toArray();
        if ($foundIndex !== false && $foundIndex >= 0) {
            $cart[$foundIndex]['quantity'] += ($request->quantity);
        } else {
            $cart[] = [
                'product' => Product::find($product_id),
                'quantity' => $request->quantity,
                'size' => ValueAttribute::find($request->size)->value,
                'color' => ValueAttribute::find($request->color)->value,
                'image' => Product::find($product_id)->images->first()->path,
            ];
        }
        session()->put('cart', $cart);
        $count = count(session('cart', []));
        return [
            'view' => view('user.cart', compact('cart'))->render(),
            'count' => $count,
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function selectedCart(Request $request): array
    {
        if (!empty($request->selected)) {
            $selectedCart = [];
            $cart = collect(session('cart', []));
            $cart->each(function ($item, $index) use (&$selectedCart, $request) {
                if (in_array($index, $request->selected)) {
                    $selectedCart[] = $item;
                    $selectedCart[count($selectedCart) - 1]['index'] = $index;
                    $selectedCart = array_values($selectedCart);
                }
            });
            session()->put('selectedCart', $selectedCart);
            $count = count(session('selectedCart', []));
            return [
                'view' => view('user.design.view_cart.list_cart_selected', compact('selectedCart', 'cart'))->render(),
                'count' => $count,
            ];
        } else {
            session()->forget('selectedCart');
            $cart = collect(session('cart', []));
            $count = count(session('cart', []));
            return [
                'view' => view('user.design.view_cart.list_data', compact('cart'))->render(),
                'count' => $count,
            ];
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeCart(Request $request): array
    {

        $id = request()->get('id');
        $tmpCart = collect(session('cart', []));
        $cartSelected = collect(session('selectedCart', []));
        $existsInCart = $tmpCart->has($id);
        $existsInSelectedCart = $cartSelected->contains('index', $id);

        if ($existsInCart && !$existsInSelectedCart) {
            $tmpCart = $tmpCart->reject(function ($item, $index) use ($id) {
                return $index == $id;
            })->values();
            session()->put('cart', $tmpCart->toArray());

            $cartSelected = $cartSelected->map(function ($item) use ($id) {
                if ($item['index'] > $id) {
                    $item['index'] -= 1;
                }
                return $item;
            })->values();
            session()->put('selectedCart', $cartSelected->toArray());
        } elseif ($existsInCart && $existsInSelectedCart) {
            $tmpCart = $tmpCart->reject(function ($item, $index) use ($id) {
                return $index == $id;
            })->values();

            $cartSelected = $cartSelected->reject(function ($item) use ($id) {
                return $item['index'] == $id;
            })->values();

            session()->put('cart', $tmpCart->toArray());
            session()->put('selectedCart', $cartSelected->toArray());
        }

        $cart = session()->get('cart', []);
        $count = count($cart);
        $selectedCart = session()->get('selectedCart', []);
        if (count($selectedCart) > 0) {
            return [
                'view' => view('user.design.view_cart.list_cart_selected', compact('selectedCart', 'cart'))->render(),
                'count' => $count,
                'html' => view('user.cart', compact('cart'))->render(),
            ];
        } else {
            session()->forget('selectedCart');
            return [
                'view' => view('user.design.view_cart.list_data', compact('cart'))->render(),
                'html' => view('user.cart', compact('cart'))->render(),
                'count' => $count,
            ];
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateQuantity(): array
    {
        $id = request()->get('id');
        $quantity = request()->get('quantity');
        $cart = collect(session('cart', []));
        $foundIndex = $cart->search(function ($item, $index) use ($id) {
            return $index == $id;
        });
        $cart = $cart->toArray();

        if ($foundIndex !== false && $foundIndex >= 0 && $quantity > 0) {
            $cart[$foundIndex]['quantity'] = $quantity;
        }

        $cartSelected = collect(session('selectedCart', []));
        $existsInSelectedCart = $cartSelected->contains('index', $id);
        if ($existsInSelectedCart) {
            $updateCart = $cartSelected->map(function ($item) use ($id, $quantity) {
                if ($item['index'] == $id) {
                    $item['quantity'] = $quantity;
                }
                return $item;
            })->values();
            session()->put('selectedCart', $updateCart->toArray());
        }

        session()->put('cart', $cart);
        $selectedCart = session()->get('selectedCart', []);
        $count = count(session('cart', []));
        if (count($selectedCart) > 0) {
            return [
                'view' => view('user.design.view_cart.list_cart_selected', compact('selectedCart', 'cart'))->render(),
                'count' => $count,
                'html' => view('user.cart', compact('cart'))->render(),
            ];
        } else {
            session()->forget('selectedCart');
            return [
                'view' => view('user.design.view_cart.list_data', compact('cart'))->render(),
                'count' => $count,
                'html' => view('user.cart', compact('cart'))->render(),
            ];
        }
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function deleteCart(Request $request): array
    {
        $id = request()->get('id');
        $tmpCart = collect(session('cart', []));
        $cartSelected = collect(session('selectedCart', []));
        $existsInCart = $tmpCart->has($id);
        $existsInSelectedCart = $cartSelected->contains('index', $id);

        if ($existsInCart && !$existsInSelectedCart) {
            $tmpCart = $tmpCart->reject(function ($item, $index) use ($id) {
                return $index == $id;
            })->values();
            session()->put('cart', $tmpCart->toArray());

            $cartSelected = $cartSelected->map(function ($item) use ($id) {
                if ($item['index'] > $id) {
                    $item['index'] -= 1;
                }
                return $item;
            })->values();
            session()->put('selectedCart', $cartSelected->toArray());
        } elseif ($existsInCart && $existsInSelectedCart) {
            $tmpCart = $tmpCart->reject(function ($item, $index) use ($id) {
                return $index == $id;
            })->values();

            $cartSelected = $cartSelected->reject(function ($item) use ($id) {
                return $item['index'] == $id;
            })->values();

            session()->put('cart', $tmpCart->toArray());
            session()->put('selectedCart', $cartSelected->toArray());
        }

        $count = count(session('cart', []));
        $cart = session()->get('cart', []);
        $selectedCart = session()->get('selectedCart', []);
        if (count($selectedCart) > 0) {
            return [
                'view' => view('user.design.view_cart.list_cart_selected', compact('selectedCart', 'cart'))->render(),
                'count' => $count,
                'html' => view('user.cart', compact('cart'))->render(),
            ];
        } else {
            session()->forget('selectedCart');
            return [
                'view' => view('user.design.view_cart.list_data', compact('cart'))->render(),
                'count' => $count,
                'html' => view('user.cart', compact('cart'))->render(),
            ];
        }

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkout(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);

        return view('user.design.check_out.index', compact('brands', 'products', 'categories', 'cart'));
    }

    /**
     * @throws \Throwable
     */
    public function process(Request $request)
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

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $cartCollect = collect(session('cart', []));
        $subTotal = $cartCollect->sum(function ($cartItem) {
            if (!$cartItem['product']->discount) {
                return $cartItem['quantity'] * $cartItem['product']->price;
            } else {
                return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
            }
        });
        $totalMoney = $subTotal + ($subTotal * 0.1) + (15000 * count($cartCollect));
        $order = collect(session('order', []));
        $order = $order->toArray();

        foreach ($cartCollect as $cartItem) {
            $order[] = [
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
            ];
        }

        session()->put('order', $order);
        $finalTotal = round(($totalMoney / 22180), 2);
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
                ->route('checkout')
                ->with('error', 'Đã xảy ra lỗi');

        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Đã xảy ra lỗi');
        }
    }


    public function success(Request $request): \Illuminate\Http\RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $orders = session()->get('order', []);

            try {
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
                        'sold' => $cartItem['product']->sold + $cartItem['quantity'],
                        'stock' => $cartItem['product']->stock - $cartItem['quantity'],
                    ]);
                });

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Đã xảy ra lỗi về thanh toán');
            };

            $count = OrderDetail::where('status', 0)->count();
            $name = $orders[0]['fullname'];
            event(new UserOrderEvent($name, $count));
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

    public function cancel(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.check_out.index', compact('brands', 'products', 'categories', 'cart'))->with('error', $response['message'] ?? 'Bạn đã hủy hành động');
    }
}
