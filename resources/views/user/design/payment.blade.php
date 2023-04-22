@extends('user.layout')
@section('title')
    Trang payment của {{ Auth::user()->name }}
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
                        <?php $cartCollect = collect($payments);
                        $subTotal = $cartCollect->sum(function ($cartItem) {
                            if (!$cartItem['product']->discount) {
                                return $cartItem['quantity'] * $cartItem['product']->price;
                            } else {
                                return $cartItem['quantity'] * ($cartItem['product']->price - ($cartItem['product']->discount / 100) * $cartItem['product']->price);
                            }
                        });
                        ?>
                        @if (App\Models\Information::where('user_id', Auth::user()->id)->first())
                            <form action="{{ url('/process-transaction') }}" method="POST">
                                @csrf
                                @foreach (App\Models\Information::where('user_id', Auth::user()->id)->get() as $information)
                                    <p>
                                        <label for="fullname">Full Name<span></span></label>
                                        <input type="text" name="fullname" value="{{ $information->fullname }}">
                                    </p>
                                    <p>
                                        <label for="phone">Phone<span></span></label>
                                        <input type="phone" name="phone" value="{{ $information->phone }}">
                                    </p>
                                    <p>
                                        <label for="address">Address<span></span></label>
                                        <input type="text" name="address" value="{{ $information->address }}">
                                    </p>
                                    @if ($product->vouchers->count() > 0)
                                        <p>
                                            <label for="voucher">Chọn voucher giảm giá<span></span></label>
                                            <select name="voucher"
                                                style="height: 49px;
                                     width: 106%;"
                                                id="voucher_item">
                                                <option selected>Chọn voucher</option>
                                                @foreach ($product->vouchers as $voucher)
                                                    @if ($voucher->quantity > 0)
                                                        <option value="{{ $voucher->percent }}">{{ $voucher->value }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </p>
                                    @endif
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
                            <form action="{{ url('/process-transaction') }}" method="POST">
                                @csrf
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
                                @if ($product->vouchers->count() > 0)
                                    <p>
                                        <label for="voucher">Chọn voucher giảm giá<span></span></label>
                                        <select name="voucher"
                                            style="height: 49px;
                                     width: 106%;"
                                            id="voucher_item">
                                            <option>Chọn voucher</option>
                                            @foreach ($product->vouchers as $voucher)
                                                @if ($voucher->quantity > 0)
                                                    <option value="{{ $voucher->percent }}">{{ $voucher->value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </p>
                                @endif
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
                                        <span>{{ number_format(15000) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Tax</span>
                                        <span>{{ number_format($subTotal * 0.1) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Tổng tất cả</span>
                                        <span class="total">{{ number_format($subTotal + 15000 + $subTotal * 0.1) }}
                                            VND</span>
                                    </li>
                                </ul>
                            </div>
                            <ul class="products mini">
                                @foreach ($payments as $cart_product)
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
        let total = document.querySelector('.total');
        console.log(total.text);
        let voucher = document.querySelector('#voucher_item');
        voucher.addEventListener('change', (e) => {
            const res = fetch(`http://127.0.0.1:8000/payment/voucher/${e.target.value}`)
                .then((response) => response.json())
                .then((data) => {
                    showVoucher(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        })

        function showVoucher(data) {
            console.log(data)
            let total = document.querySelector('.total');
            let ship = (15000 * data.result.length);
            const caculator = data.result.reduce((total, cartItem) => {
                if (data.result[0].product.discount) {
                    return total + cartItem.quantity * (cartItem.product.price - ((cartItem.product
                        .price) * ((cartItem.product.discount) / 100)));
                } else {
                    return total + cartItem.quantity * (cartItem.product.price);
                }
            }, 0);
            if (data.result[0].voucher > 100) {
                total.innerText = ((caculator + (caculator * 0.1) + ship) - data.result[0].voucher).toLocaleString(
                    'vi-VN') + ' VND';
            } else if (data.result[0].voucher > 0 && data.result[0].voucher <= 100) {
                total.innerText = (Math.floor((caculator + (caculator * 0.1) + ship) - ((caculator + (caculator * 0.1) +
                    ship) * (data.result[0].voucher / 100)))).toLocaleString('vi-VN') + ' VND';
            } else {
                total.innerText = (caculator + (caculator * 0.1) + ship).toLocaleString('vi-VN') + ' VND';
            }
        }
    </script>
@endsection
