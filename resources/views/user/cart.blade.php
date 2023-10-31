<div class="content">
    <div class="cart_head" id="card_head">
        <p>Có {{ count($cart) }} sản phẩm</p>
    </div>
    <?php
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id);
        }
    ?>
    <div class="cart_body">
        <ul class="products mini" id="card_body">
            @if (Session::has('cart'))
                @foreach ($cart as $key=>$cart_product)
                    <li class="item" style="margin-bottom: 1em">
                        <div class="thumbnail object_cover">
                            <a href="#">
                                <img src="{{ $cart_product['image'] }}" alt="???">
                            </a>
                        </div>
                        <span class="item_content">
                            @if ($cart_product['product']->sale == 0)
                                <p style="margin-bottom:0"><a
                                        href="{{ url('detail/' . $cart_product['product']->slug) }}">{{ Illuminate\Support\Str::of($cart_product['product']->name)->words(9) }}</a>
                                </p>
                            @else
                                <p style="margin-bottom: 0"><a
                                        href="{{ url('pageoffer/' . $cart_product['product']->slug) }}">{{ Illuminate\Support\Str::of($cart_product['product']->name)->words(9) }}</a>
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
                        </span>
                        <a href="#" class="item_remove" id="item_remove"
                           onclick="remove_cart({{ $key }})">
                            <i class="ri-close-line"></i>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    @if(count($cart) > 0)
        <div class="cart_footer">
            <div class="subtotal" id="subtotal">
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

                    ?>

                <p>VAT sản phẩm <small>(10%)</small></p>
                <p><strong>{{ number_format($subTotal * 0.1) }} VND</strong></p>
                <p>Tổng tiền</p>
                <p>
                    <strong>{{ number_format($subTotal + $subTotal * 0.1) }}
                        VND</strong></p>
            </div>
            <div class="actions">
                <div class="checkout_page">
                    @if (Auth::check() && count($cart) > 0)
                        <a href="{{ url('checkout') }}"
                           class="primary_button">Thanh toán</a>
                    @endif
                </div>
                @if (Auth::check())
                    @if(empty($user->information->district) && empty($user->information->province))
                        <a href="javascript:void(0)" onclick="return confirm_btn(this, {{Auth::user()->id}})" class="secondary_button">Đến xem giỏ
                            hàng</a>
                    @else
                        <a href="{{ route('view_cart') }}" class="secondary_button">Đến xem giỏ
                            hàng</a>
                    @endif

                @endif

            </div>
        </div>
    @endif
</div>
<script defer>
    function confirm_btn(eve, id) {
        let href = '{{ url('information/create-address') }}' + '/' + id ;
        swal({
            title: "Bạn chưa có thông tin về địa chỉ",
            text: "Bạn có muốn cập nhật thông tin địa chỉ không?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = href;
            } else {
                swal("Bạn có thể cập nhật thông tin địa chỉ sau");
                return false;
            }
        });
    }
    function remove_cart(id) {
        $.ajax({
            url: "{{ route('remove_cart') }}",
            method: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                $('#mini_cart').fadeOut(200, function () {
                    $(this).html(data.html);
                    $(this).fadeIn(200);
                });
                if ({{request()->route()->getName() == 'view_cart'}}) {
                    $('#show-data').html(data.view);
                }
                $('#item_number').text(data.count);
                $('#card_head').text(data.count);
                createNoti('Đã xóa sản phẩm');
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }
</script>
