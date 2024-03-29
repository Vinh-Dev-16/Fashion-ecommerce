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
                        $weight = array_sum(array_column($cart, 'product.weight'));
                        $province = \App\Helpers\SubStringAddress::subStringProvince(\Illuminate\Support\Facades\Auth::user()->information->province);
                        $district = \App\Helpers\SubStringAddress::subStringDistrict(\Illuminate\Support\Facades\Auth::user()->information->district);
                        $data = \App\Helpers\GetShip::getShip($province, $district, $weight, $subTotal);
                        $fee = $data['results'][0]['fee'];
                        $pickUp = $data['results'][0]['pickup']['name'];
                        $delivery = $data['results'][0]['delivery']['name'];
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
                                        <label for="province">Thành phố<span></span></label>
                                        <input type="text" name="province" value="{{ $information->province }}" disabled style="cursor: no-drop">
                                    </p>
                                    <p>
                                        <label for="district">Huyện<span></span></label>
                                        <input type="text" name="district" value="{{ $information->district }}" disabled style="cursor: no-drop">
                                    </p>
                                    <p>
                                        <label for="commune">Xã/Phường<span></span></label>
                                        <input type="text" name="commune" value="{{ $information->commune }}" disabled style="cursor: no-drop">
                                    </p>
                                    <p>
                                        <label for="address">Địa chỉ<span></span></label>
                                        <input type="text" name="address" value="{{ $information->address }}">
                                    </p>
                                    @if ($product->brand->vouchers->count() > 0)
                                        <p>
                                            <label for="voucher">Chọn voucher giảm giá<span></span></label>
                                            <select name="voucher"
                                                style="height: 49px;
                                     width: 106%;"
                                                id="voucher_item">
                                                <option selected>Chọn voucher</option>
                                                @foreach ($product->brand->vouchers as $voucher)
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
                                <input type="text" name="fee" value="{{$fee}}" hidden>
                                <div class="primary_checkout">
                                    <button class="primary_button"
                                            type="submit">Thanh toán Paypal</button>
                                </div>

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
                                @if ($product->brand->vouchers->count() > 0)
                                    <p>
                                        <label for="voucher">Chọn voucher giảm giá<span></span></label>
                                        <select name="voucher"
                                            style="height: 49px;
                                     width: 106%;"
                                            id="voucher_item">
                                            <option>Chọn voucher</option>
                                            @foreach ($product->brand->vouchers as $voucher)
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
                                <input type="text" name="fee" value="{{$fee}}" hidden>
                                <div class="primary_checkout"><button class="primary_button"
                                        type="submit">Thanh toán Paypal</button></div>
                            </form>
                        @endif
                        <button id="pay_cash">Hoặc trả tiền mặt</button>
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
                                        <span>{{ number_format($fee) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Gửi đi </span>
                                        <span>{{$pickUp}}</span>
                                    </li>
                                    <li>
                                        <span>Giao ngày</span>
                                        <span>{{$delivery}}</span>
                                    </li>
                                    <li>
                                        <span>Tax</span>
                                        <span>{{ number_format($subTotal * 0.1) }} VND</span>
                                    </li>
                                    <li>
                                        <span>Tổng tất cả</span>
                                        <span class="total">{{ number_format($subTotal + $fee + $subTotal * 0.1) }}
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
   @include('user.design.payment.script')
@endsection
