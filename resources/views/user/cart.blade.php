<div class="content">
    <div class="cart_head" id="card_head">
        <p>Có {{ count($cart) }} sản phẩm</p>
    </div>
    <div class="cart_body">
        <ul class="products mini" id="card_body">
            @if (Session::has('cart'))
                @foreach ($cart as $cart_product)
                    <li class="item" style="margin-bottom: 1em">
                        <div class="thumbnail object_cover">
                            <a href="#"><img
                                    src="{{ $cart_product['image'] }}"></a>
                        </div>
                        <div class="item_content">
                            @if ($cart_product['product']->sale == 0)
                                <p style="margin-bottom:0px"><a
                                        href="{{ url('detail/' . $cart_product['product']->id) }}">{{ Illuminate\Support\Str::of($cart_product['product']->name)->words(9) }}</a>
                                </p>
                            @else
                                <p style="margin-bottom: 0px"><a
                                        href="{{ url('pageoffer/' . $cart_product['product']->id) }}">{{ Illuminate\Support\Str::of($cart_product['product']->name)->words(9) }}</a>
                                </p>
                            @endif
                            <span class="price">
                                                                    <br>
                                                                    @if ($cart_product['product']->discount)
                                    <span>{{ number_format($cart_product['quantity'] * ($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price)) }}
                                                                            VND
                                                                        </span>
                                @else
                                    <span>{{ number_format($cart_product['quantity'] * $cart_product['product']->price) }}
                                                                            VND
                                                                        </span>
                                @endif
                                                                    <span
                                                                        class="fly_item"><span>{{ $cart_product['quantity'] }}x</span></span>
                                                                </span>
                        </div>
                        <a href="#" class="item_remove" id="item_remove"
                           onclick="removeCart({{ $cart_product['product']->id }})">
                            <i class="ri-close-line"></i>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="cart_footer">
        <div class="subtotal" id="subtotal">
            <p>Phí ship</p>
            <p><strong>{{ number_format(15000) }} * {{ count($cart) }} =
                    {{ number_format(15000 * count($cart)) }} VND</strong></p>
            <?php $cartCollect = collect($cart);
            $subTotal = $cartCollect->sum(function ($cartItem) {
                if (!$cartItem['product']->discount) {
                    return $cartItem['quantity'] * $cartItem['product']->price;
                } else {
                    return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                }
            });
            ?>
            <p>VAT sản phẩm <small>(10%)</small></p>
            <p><strong>{{ number_format($subTotal * 0.1) }} VND</strong></p>
            <p>Tổng tiền</p>
            <p>
                <strong>{{ number_format($subTotal + 15000 * count($cart) + $subTotal * 0.1) }}
                    VND</strong></p>
        </div>
        <div class="actions">
            <div class="checkout_page">
                @if (Auth::check() && count($cart) > 0)
                    <a href="{{ url('checkout') }}"
                       class="primary_button">CheckOut</a>
                @else
                    <a href="#" class="primary_button"
                       onclick="createToast('Bạn cần đăng nhập hoặc có đơn hàng')">CheckOut</a>
                @endif
            </div>
            <a href="{{ route('view_cart') }}" class="secondary_button">Đến xem giỏ
                hàng</a>
        </div>
    </div>
</div>
