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
                        if ($product->discount) {
                            $subTotal =  $quantity * ($product->price - ($product->discount / 100) * $product->price);
                        } else {
                            $subTotal =  $quantity * $product->price;
                        }
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
                        @if ($product->vouchers->count() > 0)
                        <p>
                            <label for="voucher">Chọn voucher giảm giá<span></span></label>
                                <select name="voucher" style="height: 49px;
                                width: 106%;">
                                    <option selected>Chọn voucher</option>
                                    @foreach ($product->vouchers as $voucher)
                                    @if ($voucher->quantity>0)
                                    <option value="{{$voucher->percent}}">{{$voucher->value}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </p>
                            @endif
                            <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                            <input type="text" name="subtotal" value="{{$subTotal}}" hidden>
                            <input type="text" name="user_id" value="{{($subTotal + 15000  + $subTotal * 0.1)}}" hidden>
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
                                    <span>{{number_format(15000)}} VND</span>
                                </li>
                                <li>
                                    <span>Tax</span>
                                    <span>{{ number_format($subTotal * 0.1)}} VND</span>
                                </li>
                                <li>
                                    <span>Tổng tất cả</span>
                                    <span>{{ number_format($subTotal + 15000  + $subTotal * 0.1) }} VND</span>
                                </li>
                            </ul>
                        </div>
                        <ul class="products mini">
                            <li class="item">
                                <div class="thumbnail object_cover">
                                    <img src="{{$image}}" alt="{{$product->name}}">
                                </div>
                                <div class="item_content">
                                    <p>{{$product->name}}</p>
                                    <span class="price">
                                        @if ($product->discount)
                                        <span>{{ number_format($quantity * ($product->price - ($product->discount / 100) * $product->price)) }}
                                            VND
                                        </span>
                                    @else
                                       <span>{{ number_format($quantity * $product->price) }}</span>
                                        VND
                                    @endif
                                    </span>
                                    <span>x{{$quantity}}</span>
                                </div>
                            </li>
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