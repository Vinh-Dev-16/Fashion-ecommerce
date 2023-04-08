@extends('user.layout')
@section('title')
    Trang checkout của {{Auth::user()->name}}
@endsection
@section('content')

    <div class="single_checkout">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Thanh toán</li>
                    </ul>
                </div>
                <div class="checkout flexwrap">
                    <div class="item left styled">
                        <h1>Đơn thông tin</h1>
                        <?php $cartCollect = collect($cart);
                        $subTotal = $cartCollect->sum(function ($cartItem) {
                            if (!$cartItem['product']->discount) {
                                return $cartItem['quantity'] * $cartItem['product']->price;
                            } else {
                                return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                            }
                        });
                        ?>
                        <form action="">
                            <p>
                                <label for="fullname">Full Name<span></span></label>
                                <input type="text" name="fullname">
                            </p>
                            <p>
                                <label for="phone">Phone<span></span></label>
                                <input type="phone" name="phone">
                            </p>
                            <p>
                                <label for="address">Address<span></span></label>
                                <input type="text" name="address">
                            </p>
                                <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                <input type="text" name="subtotal" value="{{$subTotal}}" hidden>
                                <input type="text" name="user_id" value="{{($subTotal + 15000 * count($cart) + $subTotal * 0.1)}}" hidden>
                            <p>
                                <div class="primary_checkout"><button class="primary_button" type="s
                                    ">Thanh toán</button></div>
                            </p>
                        </form>
                    </div>
                    <div class="item right">
                        <h2>Thông tin đơn hàng</h2>
                        <div class="sumary_order ">
                            <div class="sumary_totals">
                                <ul>
                                    <li>
                                        <span>Tổng tiền</span>
                                        <span>{{number_format($subTotal)}} VND</span>
                                    </li>
                                    <li>
                                        <span>Phí ship</span>
                                        <span>{{number_format((15000) * (count($cart)))}} VND</span>
                                    </li>
                                    <li>
                                        <span>Tax</span>
                                        <span>{{ number_format($subTotal * 0.1)}} VND</span>
                                    </li>
                                    <li>
                                        <span>Tổng tất cả</span>
                                        <span>{{ number_format($subTotal + 15000 * count($cart) + $subTotal * 0.1) }} VND</span>
                                    </li>
                                </ul>
                            </div>
                            <ul class="products mini">
                                @foreach ($cart as $cart_product)
                                <li class="item">
                                    <div class="thumbnail object_cover">
                                        <img src="{{$cart_product['image']}}" alt="{{$cart_product['product']->name}}">
                                    </div>
                                    <div class="item_content">
                                        <p>{{$cart_product['product']->name}}</p>
                                        <span class="price">
                                            @if ($cart_product['product']->discount)
                                            <span>{{ number_format($cart_product['quantity'] * ($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price)) }}
                                                VND
                                            </span>
                                        @else
                                           <span>{{ number_format($cart_product['quantity'] * $cart_product['product']->price) }}</span>
                                            VND
                                        @endif
                                        </span>
                                        <span>x{{$cart_product['quantity']}}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

<script>
    const dpt_menu = document.querySelector('.dpt_menu');
    const close_menu = document.getElementById('close_menu');

    dpt_menu.classList.add('active');

    close_menu.addEventListener('click', (e) => {
        e.preventDefault();
        dpt_menu.classList.toggle('active');
    });
</script>
@endsection