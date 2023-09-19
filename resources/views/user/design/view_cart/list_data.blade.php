@if (Session::has('cart'))
    <div class="single_cart">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Giỏ hàng của bạn</li>
                    </ul>
                </div>
                <div class="page_title">
                    <h1>Giỏ hàng</h1>
                </div>
                <div class="products one cart">
                    <div class="flexwrap">
                        <form action="" method="POST" class="form_cart">
                            @csrf
                            <div class="item" style="width: 100%">
                                <table id="cart_table">
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cart as $key=>$cart_product)
                                        <tr>
                                            <td class="flexitem">
                                                @if ($cart_product['product']->sale == 0)
                                                    <div class="thumbnail">
                                                        <a
                                                            href="{{ url('detail/' . $cart_product['product']->slug) }}"><img
                                                                src="{{ $cart_product['image'] }}"
                                                                alt="{{ $cart_product['product']->name }}"></a>
                                                    </div>
                                                    <div class="content">
                                                        <strong>
                                                            <a
                                                                href="{{ url('detail/' . $cart_product['product']->slug) }}">{{ $cart_product['product']->name }}
                                                            </a>
                                                        </strong>
                                                        <p style="margin-bottom: 1px">Color:
                                                            {{ $cart_product['color'] }}</p>
                                                        <p>Size: {{ $cart_product['size'] }}</p>
                                                    </div>
                                                @else
                                                    <div class="thumbnail object_cover">
                                                        <a
                                                            href="{{ url('pageoffer/' . $cart_product['product']->slug) }}"><img
                                                                src="{{ $cart_product['image'] }}"
                                                                alt="{{ $cart_product['product']->name }}"></a>
                                                    </div>
                                                    <div class="content">
                                                        <strong>
                                                            <a
                                                                href="{{ url('pageoffer/' . $cart_product['product']->slug) }}">{{ $cart_product['product']->name }}
                                                            </a>
                                                        </strong>
                                                        <p style="margin-bottom: 1px">Color:
                                                            {{ $cart_product['color'] }}</p>
                                                        <p>Size: {{ $cart_product['size'] }}</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($cart_product['product']->discount)
                                                    <span>{{ number_format($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price) }}
                                                            </span>
                                                @else
                                                    <span>
                                                                {{ number_format($cart_product['product']->price) }}
                                                            </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="qty_control flexitem">
                                                    <div style="padding-top: 12px" class="minus"
                                                         onclick="decrement({{ $cart_product['product']->id }},this)">
                                                        -</div>
                                                    <input type="number" value="{{ $cart_product['quantity'] }}"
                                                           min="1" max="{{ $cart_product['product']->stock }}"
                                                           id="quantity_cart" disabled>
                                                    <div style="padding-top: 12px"
                                                         onclick="increment({{ $cart_product['product']->id }},{{ $cart_product['product']->stock }},this)"
                                                         class="plus">+</div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($cart_product['product']->discount)
                                                    <span
                                                        class="price_item">{{ number_format($cart_product['quantity'] * ($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price)) }}
                                                            </span>
                                                    @else
                                                        </span class="price_item">
                                                    {{ number_format($cart_product['quantity'] * $cart_product['product']->price) }}
                                                    <span>
                                                @endif
                                            </td>
                                            <td><a href="javascript:void(0)" onclick="remove_cart_view({{$key}})">
                                                    <i class="ri-close-line"></i>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="cart_sumary styled" style="margin-top: 30px">
                            <div class="item" style="width:100%">
                                <div class="coupon">
                                    <input type="text" placeholder="Hóa đơn">
                                    <button>Áp dụng</button>
                                </div>
                                <div class="shipping_rate collapse">
                                    <div class="has_child expand">
                                        <a href="#" class="icon_small">Hóa đơn bao gồm phí ship và tax</a>
                                    </div>
                                    <div class="cart_total">
                                            <?php $cartCollect = collect($cart);
                                            $subTotal = $cartCollect->sum(function ($cartItem) {
                                                if (!$cartItem['product']->discount) {
                                                    return $cartItem['quantity'] * $cartItem['product']->price;
                                                } else {
                                                    return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                                                }
                                            });

                                            $productIDs = [];
                                            foreach ($cartCollect as $cartItem) {
                                                $productId = $cartItem['product']->id;

                                                if (!in_array($productId, $productIDs)) {
                                                    $productIDs[] = $productId;
                                                }
                                            }
                                            $ship = 15000 * count($productIDs);
                                            ?>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <th>Tổng tiền</th>
                                                <td class="sub_total">{{ number_format($subTotal) }} </td>
                                            </tr>
                                            <tr>
                                                <th>Phí ship<span class="mini_text">/Product</span></th>
                                                <td>{{ number_format($ship) }} VND</td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td class="tax">{{ number_format($subTotal * 0.1) }} VND</td>
                                            </tr>
                                            <tr>
                                                <th>Tổng tất cả</th>
                                                <td class="total">
                                                    {{ number_format($subTotal + $ship + $subTotal * 0.1) }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    
                                        @if (Auth::check() && count($cart) > 0)
                                            <a href="{{ url('checkout') }}" class="secondary_button">Check out</a>
                                        @elseif (!Auth::check())
                                            <button class="secondary_button"
                                                    onclick="createToast('Bạn cần phải đăng nhập')"
                                                    style="border:none;outline:none;width:100%">Check out</button>
                                        @elseif (count($cart) == 0) 
                                            <button class="secondary_button"
                                            onclick="createToast('Bạn cần có sản phẩm')"
                                            style="border:none;outline:none;width:100%">Check out</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <h1 class="search_page">Bạn chưa có sản phẩm nào trong giỏ hàng</h1>
@endif
