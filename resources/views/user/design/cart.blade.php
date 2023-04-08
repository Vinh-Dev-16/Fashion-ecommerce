@extends('user.layout')
@section('title')
    Trang giỏ hàng của bạn
@endsection
@section('content')
    <ul class="notification">
    </ul>
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
                                        @foreach ($cart as $cart_product)
                                            <tr>
                                            <td class="flexitem">
                                                @if ($cart_product['product']->sale == 0)
                                                <div class="thumbnail">
                                                    <a href="{{ url('detail/' . $cart_product['product']->id) }}"><img src="{{$cart_product['image']}}" alt="{{$cart_product['product']->name}}"></a>
                                                </div>
                                                <div class="content" >
                                                    <strong>
                                                        <a
                                                         href="{{ url('detail/' . $cart_product['product']->id) }}">{{($cart_product['product']->name)}}
                                                        </a>
                                                    </strong>
                                                        <p style="margin-bottom: 1px">Color: {{$cart_product['color']}}</p>
                                                        <p>Size: {{$cart_product['size']}}</p>
                                                </div>
                                                @else
                                                <div class="thumbnail object_cover">
                                                    <a href="{{url('pageoffer/' . $cart_product['product']->id)}}"><img src="{{$cart_product['image']}}" alt="{{$cart_product['product']->name}}"></a>
                                                </div>
                                                <div class="content">
                                                    <strong>
                                                        <a
                                                         href="{{ url('pageoffer/' . $cart_product['product']->id) }}">{{($cart_product['product']->name)}}
                                                        </a>
                                                    </strong>
                                                        <p style="margin-bottom: 1px">Color: {{$cart_product['color']}}</p>
                                                        <p>Size: {{$cart_product['size']}}</p>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($cart_product['product']->discount)
                                                <span>{{ number_format( ($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price))}}
                                                </span>
                                            @else
                                                {{ number_format($cart_product['product']->price)}}
                                            @endif
                                            </td>
                                            <td>
                                                <div class="qty_control flexitem">
                                                    <button class="minus">-</button>
                                                    <input type="number" value="{{$cart_product['quantity']}}" min="1" max="{{$cart_product['product']->stock}}" disabled>
                                                    <button class="plus">+</button>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($cart_product['product']->discount)
                                                <span>{{ number_format($cart_product['quantity'] * ($cart_product['product']->price - ($cart_product['product']->discount / 100) * $cart_product['product']->price)) }}
                                                </span>
                                            @else
                                                {{ number_format($cart_product['quantity'] * $cart_product['product']->price) }}
                                            @endif
                                            </td>
                                            <td><a href="{{url('deletecart',['id'=>$cart_product['product']->id])}}">
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
                                            ?>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>Tổng tiền</th>
                                                    <td>{{number_format($subTotal)}} VND</td>
                                                </tr>
                                                <tr>
                                                    <th>Phí ship<span class="mini_text">/Product</span></th>
                                                    <td>{{number_format((15000) * (count($cart)))}} VND</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax</th>
                                                    <td>{{ number_format($subTotal * 0.1)}} VND</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng tất cả</th>
                                                    <td>{{ number_format($subTotal + 15000 * count($cart) + $subTotal * 0.1) }} VND
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @if (Auth::check())
                                        <a href="{{url('checkout')}}" class="secondary_button">Check out</a>
                                        @else
                                        <button class="secondary_button" onclick="createNoti('Bạn cần phải đăng nhập')" style="border:none;outline:none;width:100%">Check out</button>   
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


@endsection

@section('javascript')

  @if (!(Auth::check()))
      <script>
         const notifications = document.querySelector('.notification');
         const timer = 3000;
      </script>
  @endif
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