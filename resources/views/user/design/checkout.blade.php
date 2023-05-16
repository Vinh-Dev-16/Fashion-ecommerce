@extends('user.layout')
@section('title')
    Trang checkout của {{ Auth::user()->name }}
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
                        <h1>Thông tin khách hàng</h1>
                        <?php $cartCollect = collect($cart);
                        $subTotal = $cartCollect->sum(function ($cartItem) {
                            if (!$cartItem['product']->discount) {
                                return $cartItem['quantity'] * $cartItem['product']->price;
                            } else {
                                return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                            }
                        });
                        ?>
                        @if (App\Models\Information::where('user_id', Auth::user()->id)->first())
                            <form action="{{ url('/process') }}" method="POST">
                                @csrf
                                @foreach (App\Models\Information::where('user_id', Auth::user()->id)->get() as $information)
                                    <p>
                                        <label for="fullname">Full Name<span></span></label>
                                        <input type="text" name="fullname" value="{{ $information->fullname }}">
                                    </p>
                                    @error('fullname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <p>
                                        <label for="phone">Phone<span></span></label>
                                        <input type="phone" name="phone" value="{{ $information->phone }}">
                                    </p>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <p>
                                        <label for="address">Address<span></span></label>
                                        <input type="text" name="address" value="{{ $information->address }}">
                                    </p>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endforeach
                                <p>
                                    <label for="note">Note<span></span></label>
                                    <input type="text" name="note" id="note">
                                </p>
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                <input type="text" name="subtotal" value="{{ $subTotal }}" hidden>
                                <p>
                                <div class="primary_checkout"><button class="primary_button"
                                        type="s
                                    ">Thanh toán</button></div>
                                </p>
                            </form>
                        @else
                            <form action="{{ url('/process') }}" method="POST">
                                @csrf
                                <p>
                                    <label for="fullname">Full Name<span></span></label>
                                    <input type="text" name="fullname">
                                </p>
                                @error('fullname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <p>
                                    <label for="phone">Phone<span></span></label>
                                    <input type="phone" name="phone">
                                </p>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <p>
                                    <label for="address">Address<span></span></label>
                                    <input type="text" name="address">
                                </p>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <p>
                                    <label for="note">Note<span></span></label>
                                    <input type="text" name="note" id="note">
                                </p>
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                <input type="text" name="subtotal" value="{{ $subTotal }}" hidden>
                                <p>
                                <div class="primary_checkout">
                                    <button class="primary_button" type="submit">Thanh toán</button></div>
                                </p>
                            </form>
                        @endif
                    </div>
                    <div class="item right">
                        <h2>Thông tin đơn hàng</h2>
                        <div class="sumary_order ">
                            <div class="sumary_totals">
                                <ul>
                                    <li>
                                        <span>Tổng tiền</span>
                                        <span>{{ number_format($subTotal) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Phí ship</span>
                                        <span>{{ number_format(15000 * count($cart)) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Tax</span>
                                        <span>{{ number_format($subTotal * 0.1) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Tổng tất cả</span>
                                        <span>{{ number_format($subTotal + 15000 * count($cart) + $subTotal * 0.1) }}
                                            VND</span>
                                    </li>
                                </ul>
                            </div>
                            <ul class="products mini">
                                @foreach ($cart as $cart_product)
                                    <li class="item">
                                        <div class="thumbnail object_cover">
                                            <img src="{{ $cart_product['image'] }}"
                                                alt="{{ $cart_product['product']->name }}">
                                        </div>
                                        <div class="item_content">
                                            <p>{{ $cart_product['product']->name }}</p>
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
                                            <span>x{{ $cart_product['quantity'] }}</span>
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
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');

        for (let i of dpt_menu) {
            i.classList.add('active');
        }
        close_menu.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                for (let i of dpt_menu) {
                    i.classList.toggle('active');
                }
            });
        })
    </script>
@endsection
