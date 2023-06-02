<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/js/bootstrap.js') }}">
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('user/user.css') }}">
    <title>
        @section('title')
        @show
    </title>
</head>

<body>

    <div id="preloader" style="background: #ffffff url({{ asset('images/preview.gif') }}) no-repeat center center;">
    </div>

    @if (Session::has('success'))
        <ul class="notification">
            <li class="success toasts">
                <div class="column">
                    <i class="fa fa-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <i class="fa fa-xmark"></i>
            </li>
        </ul>
    @elseif (Session::has('error'))
        <ul class="notification">
            <li class="error toasts">
                <div class="column">
                    <i class="fa fa-check"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <i class="fa fa-xmark"></i>
            </li>
        </ul>
    @endif
    <ul class="notification">
    </ul>
    {{-- Navbar --}}
    <div id="page" class="site">
        <aside class="site_off desktop_hide">
            <div class="off_canvas">
                <div class="canvas_head flexitem">
                    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logoCart.png') }}"
                                alt="logo" style="width:30px; height:30px; margin-right:5px"><span
                                class="circle"></span><span
                                style="font-family: 'Dancing Script', cursive; color:green">.F</span><span>ashion</span></a>
                    </div>
                    <a href="#" class="t_close flexcenter"><i class="ri-close-line"></i></a>
                </div>
                <div class="departments">

                </div>
                <nav></nav>
                <div class="thetop_nav"></div>
            </div>
        </aside>
        <div class="header_nav" id="top">
            <div class="container">
                <div class="wrapper flexitem">
                    <a href="#" class="trigger desktop_hide"><i class="ri-menu-2-line"></i></a>
                    <div class="left flexitem">
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logoCart.png') }}"
                                    alt="logo" style="width:30px; height:30px; margin-right:5px"><span
                                    class="circle"></span><span
                                    style="font-family: 'Dancing Script', cursive; color:green">.F</span><span>ashion</span></a>
                        </div>
                        <nav class="mobile_hide">
                            <ul class="flexitem second_link">
                                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li class="has_child">
                                    <a href="#">Shop
                                        <i style="position: absolute " class="ri-arrow-down-s-line" id="arrow_shop"></i>
                                    </a>
                                    <div class="mega">
                                        <div class="container">
                                            <div class="wrapper">
                                                <div class="flexcol">
                                                    <div class="row">
                                                        <h4>Danh mục sản phẩm</h4>
                                                        <ul>
                                                            @foreach ($categories->take(8) as $category)
                                                                <li><a href="{{url('category/'. $category->id)}}">{{ $category->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="flexcol">
                                                    <div class="row">
                                                        <h4>Túi</h4>
                                                        <ul>
                                                            <ul>
                                                                @foreach ($categories->take(8) as $category)
                                                                    <li><a href="{{url('category/'. $category->id)}}">{{ $category->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="flexcol">
                                                    <div class="row">
                                                        <h4>Giày</h4>
                                                        <ul>
                                                            <ul>
                                                                @foreach ($categories->take(8) as $category)
                                                                    <li><a href="{{url('category/'. $category->id)}}">{{ $category->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="flexcol">
                                                    <div class="row">
                                                        <h4>Brand</h4>
                                                        <ul class="brands">
                                                            <ul>
                                                                @foreach ($brands->take(8) as $brand)
                                                                    <li><a href="{{url('brand/'.$brand->id)}}">{{ $brand->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </ul>
                                                        <a href="" class="view_all">Xem tất cả <i
                                                                class="ri-arrow-right-line"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flexcol products">
                                                    <div class="row">
                                                        <div class="media">
                                                            <div class="thumbnail object_cover">
                                                                <a href="#">
                                                                    <img src="{{ asset('images/model.jpg') }}"
                                                                        alt="Ảnh model fashion" id="model_fashion">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="text_content">
                                                            <h4>Lalala</h4>
                                                            <a href="#" class="primary_button">Shop now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">Nữ</a></li>
                                <li><a href="#">Nam</a></li>
                                <li><a href="#">Giày</a></li>
                                <li style="position: relative"><a href="#">Túi
                                        <div class="fly_item"><span>New!</span></div>
                                    </a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="right">
                        <ul class="flexitem second_links">
                            @if (Auth::check())
                                <li class="mobile_hide"><a href="{{ url('history') }}">
                                        <div class="icon_large" style="margin-top: -36px">
                                            <i class="ri-history-line"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="mobile_hide"><a href="{{ url('/wishlist/' . Auth::user()->id) }}">
                                        <div class="icon_large" style="margin-top: -36px"><i
                                                class="ri-heart-line"></i>
                                            <div class="fly_item"><span class="item_number"
                                                    id="wishlist_number">{{ App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <li class="mobile_hide" onclick="createToast('Bạn cần phải đăng nhập')">
                                    <div>
                                        <div class="icon_large" style="margin-top: -10px"><i
                                                class="ri-heart-line"></i>
                                            <div class="fly_item"><span class="item_number"
                                                    id="wishlist_number">0</span></div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="iscart">
                                <a href="#">
                                    <div class="icon_large" id="cart_product"><i
                                            class="ri-shopping-cart-line"></i>
                                        <div class="fly_item"><span class="item_number"
                                                id="item_number">{{ count($cart) }}</span></div>
                                    </div>
                                </a>

                                <div class="mini_cart" id="mini_cart">
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
                                                <p><strong>{{ number_format($subTotal + 15000 * count($cart) + $subTotal * 0.1) }}
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
                                                <a href="{{ url('viewcart') }}" class="secondary_button">Đến xem giỏ
                                                    hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>

                                @if (Auth::check())
                                    <div class="profile-dropdown">
                                        @if (Auth::user()->role_id == 4 && App\Models\OrderDetail::where('status', 2)->where('ship',0)->count() > 0)
                                            <div class="fly_item" style="top:-10px;background:red">
                                                <span
                                                    class="item_number"id="count_number">{{ App\Models\OrderDetail::where('status', 2)->where('ship',0)->count() }}
                                                </span>
                                            </div>
                                        @endif

                                        @if (Auth::user()->role_id == 2 && App\Models\OrderDetail::where('status', 0)->count() > 0)
                                            <div class="fly_item" style="top:-10px;background:red">
                                                <span
                                                    class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 0)->count() }}
                                                </span>
                                            </div>
                                        @endif
                                        <div onclick="toggle()" class="profile-dropdown-btn">
                                            @if (App\Models\Information::where('user_id', '=', Auth::user()->id)->first())
                                                <div class="profile-img"
                                                    style="background-image:url({{ asset('storage/avatar/' . App\Models\Information::where('user_id', '=', Auth::user()->id)->first()->avatar) }});border:1px solid black">
                                                @else
                                                    <div class="profile-img"
                                                        style="background-image:url({{ asset('images/user.png') }})">
                                            @endif
                                            <i class="fa-solid fa-circle"></i>
                                        </div>

                                        <span>{{ Auth::user()->name }}
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </div>

                                    <ul class="profile-dropdown-list">
                                        <li class="profile-dropdown-list-item">
                                            <a href="{{ url('information/' . Auth::user()->id) }}">
                                                <i class="fa-regular fa-user"></i>
                                                Thông tin cá nhân
                                            </a>
                                        </li>
                                        @if (!(Auth::user()->role_id == 1) && !(Auth::user()->role_id == 4))
                                            <li class="profile-dropdown-list-item">
                                                <a href="{{ url('/admin/dashboard') }}">
                                                    <i class="fa-regular fa-envelope"></i>
                                                    Trang dashboard
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->role_id == 2)
                                            <li class="profile-dropdown-list-item">
                                                <a href="{{ url('pageConfirm') }}">
                                                    <i class="fa-regular fa-envelope"></i>
                                                    Trang xác nhận đơn hàng
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->role_id == 1)
                                            <li class="profile-dropdown-list-item">
                                                <a href="{{ url('shipper') }}">
                                                    <i class="ri-run-line"></i>
                                                    Đăng kí làm shipper
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->role_id == 4)
                                            <li class="profile-dropdown-list-item">
                                                <a href="{{ url('pageShip') }}">
                                                    <i class="ri-truck-line"></i>
                                                    Check đơn hàng
                                                </a>
                                            </li>
                                        @endif
                                        <hr />
                                        <li class="profile-dropdown-list-item">
                                            <form action="{{ route('do_logout') }}" method="POST">
                                                @csrf
                                                <i style="margin-left: 0.88em"
                                                    class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <button type="submit">
                                                    Log out
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                    </div>
                @else
                    <div class="auth login">
                        <a href="{{ route('login') }}" style="font-family: 'Rubik' ,sans-serif;">Đăng
                            nhập</a>
                    </div>
                    @endif
                    <li>
                        </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Thanh search --}}

    <div class="header_main mobile_hide">
        <div class="container">
            <div class="wrapper flexitem">
                <div class="left">
                    <div class="dpt_cat">
                        <div class="dpt_head">
                            <div class="main_text">Mại zô Mại zô</div>
                            <div class="mini_text mobile_hide">Tất cả {{ $products->count() }} sản phẩm</div>
                            <a href="" class="dpt_trigger mobile_hide" id="close_menu">
                                <i class="ri-menu-3-line ri_xl"></i>
                            </a>
                        </div>
                        <div class="dpt_menu">
                            <ul class="second_links">
                                <li class="has_child beauty">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-bear-smile-line"></i></div>
                                        Beauty
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        <li><a href="#">Makeup</a></li>
                                        <li><a href="#">Skin Care</a></li>
                                        <li><a href="#">Hair Care </a></li>
                                        <li><a href="#">Fragrance</a></li>
                                        <li><a href="#">Foot & Hand Care</a></li>
                                        <li><a href="#">Tools & Accessories</a></li>
                                        <li><a href="#">Share & Hair Removal</a></li>
                                        <li><a href="#">Personal Care</a></li>
                                    </ul>
                                </li>
                                <li class="has_child electric">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-bluetooth-connect-line"></i></div>
                                        Electronic
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        <li><a href="#">Makeup</a></li>
                                        <li><a href="#">Skin Care</a></li>
                                        <li><a href="#">Hair Care </a></li>
                                        <li><a href="#">Fragrance</a></li>
                                        <li><a href="#">Foot & Hand Care</a></li>
                                        <li><a href="#">Tools & Accessories</a></li>
                                        <li><a href="#">Share & Hair Removal</a></li>
                                        <li><a href="#">Personal Care</a></li>
                                    </ul>
                                </li>
                                <li class="has_child woman">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-t-shirt-air-line"></i></div>
                                        Women's Fashion
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        <li><a href="#">Makeup</a></li>
                                        <li><a href="#">Skin Care</a></li>
                                        <li><a href="#">Hair Care </a></li>
                                        <li><a href="#">Fragrance</a></li>
                                        <li><a href="#">Foot & Hand Care</a></li>
                                        <li><a href="#">Tools & Accessories</a></li>
                                        <li><a href="#">Tools & Accessories</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-t-shirt-line"></i></div>
                                        Men's Fashion
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-user-5-line"></i></div>
                                        Girl's Fashion
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-user-6-line"></i></div>
                                        Boy's Fashion
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-heart-pulse-line"></i></div>
                                        Health & Household
                                    </a>
                                </li>
                                <li class="has_child homekit">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-home-8-line"></i></div>
                                        Home & Kitchen
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <div class="mega">
                                        <div class="flexcol">
                                            <div class="row">
                                                <h4><a href="#">Kitchen & Dining</a></h4>
                                                <ul>
                                                    <li><a href="#">Kitchen</a></li>
                                                    <li><a href="#">Dining Room</a></li>
                                                    <li><a href="#">Pantry</a></li>
                                                    <li><a href="#">Great Room</a></li>
                                                    <li><a href="#">Breakfast Nook</a></li>
                                                    <li><a href="#">Great Room</a></li>
                                                    <li><a href="#">Breakfast Nook</a></li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <h4><a href="#">Living</a></h4>
                                                <ul>
                                                    <li><a href="#">Kitchen</a></li>
                                                    <li><a href="#">Dining Room</a></li>
                                                    <li><a href="#">Pantry</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="flexcol">
                                            <div class="row">
                                                <h4><a href="#">Bed & Bath</a></h4>
                                                <ul>
                                                    <li><a href="#">Bathroom</a></li>
                                                    <li><a href="#">Dining Room</a></li>
                                                    <li><a href="#">Pantry</a></li>
                                                    <li><a href="#">Great Room</a></li>
                                                    <li><a href="#">Breakfast Nook</a></li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <h4><a href="#">Utility</a></h4>
                                                <ul>
                                                    <li><a href="#">Laudry</a></li>
                                                    <li><a href="#">Garage</a></li>
                                                    <li><a href="#">Mudroom</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="flexcol">
                                            <div class="row">
                                                <h4><a href="#">Outdoor</a></h4>
                                                <ul>
                                                    <li><a href="#">Bathroom</a></li>
                                                    <li><a href="#">Dining Room</a></li>
                                                    <li><a href="#">Pantry</a></li>
                                                    <li><a href="#">Great Room</a></li>
                                                    <li><a href="#">Breakfast Nook</a></li>
                                                    <li><a href="#">Bathroom</a></li>
                                                    <li><a href="#">Dining Room</a></li>
                                                    <li><a href="#">Pantry</a></li>
                                                    <li><a href="#">Great Room</a></li>
                                                    <li><a href="#">Breakfast Nook</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-android-line"></i></div>
                                        Pet Supplies
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-basketball-line"></i></div>
                                        Sports
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-shield-star-line"></i></div>
                                        Best Seller
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="search_box">
                        <form action="{{ url('searchpage') }}" class="search">
                            <span class="icon_large"><i class="ri-search-line" style="margin-bottom:16px"></i></span>
                            <input type="search" placeholder="Tìm kiếm tên sản phẩm" name="search"
                                id="search_product">
                            <button type="submit">Search</button>
                        </form>
                        <ul class="search_results">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_fashion site">
        @section('content')
        @show
        @section('modal')
        @show

        {{-- banner --}}

        <div class="banners">
            <div class="container">
                <div class="wrapper">
                    <div class="column">
                        <div class="banner flexwrap">
                            <div class="row">
                                <div class="item">
                                    <div class="image">
                                        <img src="{{ asset('images/banner1.jpg') }}" alt="Banner1">
                                    </div>
                                    <div class="text_content flexcol">
                                        <h4>Brutal Sale</h4>
                                        <h3><span>Lấy discount tại đây!!!</span><br>Shop Fashion</h3>
                                        <a href="#" class="primary_button">Shop now</a>
                                    </div>
                                    <a href="#" class="over_link"></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item get_gray">
                                    <div class="image">
                                        <img src="{{ asset('images/banner2.jpg') }}" alt="Banner1">
                                    </div>
                                    <div class="text_content flexcol">
                                        <h4>Brutal Sale</h4>
                                        <h3><span>Giảm giá vào mọi lúc !!!</span><br>Shop Fashion</h3>
                                        <a href="#" class="primary_button">Shop now</a>
                                    </div>
                                    <a href="#" class="over_link"></a>
                                </div>
                            </div>
                        </div>
                        {{-- category --}}

                        <div class="products_categories flexwrap">
                            <div class="row">
                                <div class="item">
                                    <div class="image">
                                        <img src="{{ asset('images/procat1.jpg') }}" alt="Category1">
                                    </div>
                                    <div class="content mini_links">
                                        <h4>Beauty</h4>
                                        <ul class="flexcol">
                                            <li><a href="#">Makeup</a></li>
                                            <li><a href="#">Skin Care</a></li>
                                            <li><a href="#">Hair Care</a></li>
                                            <li><a href="#">Fragrance</a></li>
                                            <li><a href="#">Foot & Hand Care</a></li>
                                        </ul>
                                        <div class="second_links"><a href="#" class="view_all">Xem tất cả<i
                                                    class="ri-arrow-right-line"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('images/procat2.jpg') }}" alt="Category2">
                                        </a>
                                    </div>
                                    <div class="content mini_links">
                                        <h4><a href="#">Gatdets</a></h4>
                                        <ul class="flexcol">
                                            <li><a href="#">Camera</a></li>
                                            <li><a href="#">Cell phones</a></li>
                                            <li><a href="#">Computes</a></li>
                                            <li><a href="#">GPS & Navigation</a></li>
                                            <li><a href="#">Headphones</a></li>
                                        </ul>
                                        <div class="second_links"><a href="#" class="view_all">Xem tất cả<i
                                                    class="ri-arrow-right-line"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('images/procat3.jpg') }}" alt="Category2">
                                        </a>
                                    </div>
                                    <div class="content mini_links">
                                        <h4><a href="#">Home Decor</a></h4>
                                        <ul class="flexcol">
                                            <li><a href="#">Kitchen</a></li>
                                            <li><a href="#">Dinning Room</a></li>
                                            <li><a href="#">Pantry</a></li>
                                            <li><a href="#">Great Room</a></li>
                                            <li><a href="#">Breakfast Nook</a></li>
                                        </ul>
                                        <div class="second_links"><a href="#" class="view_all">Xem tất cả<i
                                                    class="ri-arrow-right-line"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}

    <footer style="position: relative">
        <div class="widgets">
            <div class="container">
                <div class="wrapper">
                    <div class="flexwrap">
                        <div class="row">
                            <div class="item mini_links">
                                <h4>Help & Contact</h4>
                                <ul class="flexcol">
                                    <li><a href="">Your Account</a></li>
                                    <li><a href="">Your Order</a></li>
                                    <li><a href="">Shipping Rate</a></li>
                                    <li><a href="">Returns</a></li>
                                    <li><a href="">Assistant</a></li>
                                    <li><a href="">Help</a></li>
                                    <li><a href="">Contact US</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="item mini_links">
                                <h4>Product Category</h4>
                                <ul class="flexcol">
                                    <li><a href="">Beauty</a></li>
                                    <li><a href="">Electronic</a></li>
                                    <li><a href="">Women's Fashion</a></li>
                                    <li><a href="">Men's Fashion</a></li>
                                    <li><a href="">Girl's Fashion</a></li>
                                    <li><a href="">Boy's Fashion</a></li>
                                    <li><a href="">Health & HouseHold</a></li>
                                    <li><a href="">Home & Kitchen</a></li>
                                    <li><a href="">Pet Suppeise</a></li>
                                    <li><a href="">Sports</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="item mini_links">
                                <h4>Payment Info</h4>
                                <ul class="flexcol">
                                    <li><a href="">Bussiness Card</a></li>
                                    <li><a href="">Shop with Points</a></li>
                                    <li><a href="">Reload your Balance</a></li>
                                    <li><a href="">Payal</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="item mini_links">
                                <h4>About Us</h4>
                                <ul class="flexcol">
                                    <li><a href="">Company Info</a></li>
                                    <li><a href="">News</a></li>
                                    <li><a href="">Inverstor</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Customer Reviews</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_info">
            <div class="conatainer">
                <div class="wrapper">
                    <div class="flexcol">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logoCart.png') }}"
                                    alt="logo" style="width:30px; height:30px; margin-right:5px"><span
                                    class="circle"></span><span
                                    style="font-family: 'Dancing Script', cursive; color:green">.F</span><span>ashion</span></a>
                        </div>
                        <div class="socials">
                            <ul class="flexitem">
                                <li><a href=""><i class="ri-twitter-line"></i></a></li>
                                <li><a href=""><i class="ri-facebook-line"></i></a></li>
                                <li><a href=""><i class="ri-instagram-line"></i></a></li>
                                <li><a href=""><i class="ri-github-line"></i></a></li>
                                <li><a href=""><i class="ri-youtube-line"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="mini_text">Copyright &copy; 2022 <strong><a
                                href="{{ url('/') }}">FASHION</a>.</strong>
                        All rights reserved.</p>
                </div>
            </div>
        </div>
        <div class="backtotop">
            <a href="#top" class="flexcol">
                <i class="ri-arrow-up-line"></i>
                <span>Top</span>
            </a>
        </div>
        <div class="chat">
            <a href="{{ url('/chatify/1') }}" class="flexcol" style="bottom: 5em; right:2em">
                <i class="ri-chat-1-line"></i>
                <span>Chat</span>
            </a>
        </div>
        <div class="menu_bottom desktop_hide">
            <div class="container">
                <div class="wrapper">
                    <nav>
                        <ul class="flexitem">
                            <li>
                                <a href="">
                                    <i class="ri-bar-chart-line"></i>
                                    <span>Trending</span>
                                </a>
                            </li>
                            @if (Auth::check())
                                <li>
                                    <a href="{{ url('information/' . Auth::user()->id) }}">
                                        <i class="ri-user-6-line"></i>
                                        <span>Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('wishlist/' . Auth::user()->id) }}">
                                        <i class="ri-heart-line"></i>
                                        <span>Wishlist</span>
                                        <div class="fly_item"><span class="item_number"
                                                id="wishlist_number">{{ App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}</span>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('/login') }}">
                                        <i class="ri-user-6-line"></i>
                                        <span>Login</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="createNoti('Bạn cần phải đăng nhập')">
                                        <i class="ri-heart-line"></i>
                                        <span>Wishlist</span>
                                        <div class="fly_item">
                                            <span class="item_number" id="wishlist_number">0</span>
                                        </div>
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="" class="t_search">
                                    <i class="ri-search-line"></i>
                                    <span>Search</span>
                                </a>
                            </li>
                            @if (Auth::check())
                            <li>
                                <a href="{{ url('history') }}">
                                    <i class="ri-history-line"></i>
                                    <span>History</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        {{-- Thanh seach responsive --}}

        <div class="search_bottom desktop_hide">
            <div class="container">
                <div class="wrapper search_box">
                    <form action="" class="seach">
                        <a href="" class="t_close search_close flexcenter"><i class="ri-close-line"></i>
                        </a>
                        <span class="icon_large">
                         <i class="ri-search-line"></i>
                         </span>
                        <input type="search" placeholder="Tìm kiếm product">
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    </div>




    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{asset('user/main.js')}}"></script>   --}}
    {{-- CDN Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- CDN jquery --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  
    @if (Auth::check() && Auth::user()->role_id == 2)
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('194699ac18e541ed2d38', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('popup-channel');
            channel.bind('my-event', function(data) {
                createNoti(data.name + ' đã đặt hàng');
                let count_number = document.querySelector("#count_number");
                if(count_number){
                    document.querySelector('#count_number').innerText = data.count;
                }else{
                    let countNumber = createElement('div');
                    countNumber.className = "fly_item";
                    let renderNumber = `
                    <span  class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 0)->count() }}
                    </span>
                    `;
                    countNumber.innerHTML = renderNumber;
                    document.querySelector(".profile-dropdown").appendChild(countNumber);
                }
            });
        </script>
    @endif
    @if (Auth::check() && Auth::user()->role_id == 4)
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('194699ac18e541ed2d38', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('popup-confirm');
            channel.bind('my-handle', function(data) {
                createNoti('Đã có đơn hàng cần ship');
                if(count_number){
                    document.querySelector('#count_number').innerText = data.count;
                }else{
                    let countNumber = createElement('div');
                    countNumber.className = "fly_item";
                    let renderNumber = `
                    <span class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 2)->where('ship',0)->count() }}
                    </span>
                    `;
                    countNumber.innerHTML = renderNumber;
                    document.querySelector(".profile-dropdown").appendChild(countNumber);
                }
            });
        </script>
    @endif
    <script>
        window.addEventListener('load', () => {
            document.querySelector('#preloader').style.display = "none";
        })

        // Phần sidebar

        copyMenu();

        function copyMenu() {
            let dptCategory = document.querySelector('.dpt_cat');
            let dptPlace = document.querySelector('.departments');
            dptPlace.innerHTML = dptCategory.innerHTML;

            let mainNav = document.querySelector('.header_nav nav');
            let navPlace = document.querySelector('.off_canvas nav');
            navPlace.innerHTML = mainNav.innerHTML;

        }

        const menuButton = document.querySelector('.trigger'),
            closeButton = document.querySelector('.t_close'),
            addclass = document.querySelector('.site');
        menuButton.addEventListener('click', () => {
            addclass.classList.toggle('showmenu');
        });

        closeButton.addEventListener('click', () => {
            addclass.classList.remove('showmenu');
        });

        // Tao remove toast

        const notifications = document.querySelector('.notification');
        const toast = document.querySelector('.toasts');
        const timer = 3000;

        const removeNoti = (noti) => {
            noti.classList.add("hide");
            if (noti.timeoutId) clearTimeout(noti.timeoutId);
            setTimeout(() => noti.remove(), 400);
        };


        // Tao Toast

        function createNoti(message) {
            const noti = document.createElement('li');
            noti.className = `toasts success`;
            noti.innerHTML = `
                        <div class="column">
                            <i class="fa-solid fa-check"></i>
                            <span>${message}</span>
                        </div>
                        <i class="fa-solid fa-x"></i>
                        `
            notifications.appendChild(noti);
            setTimeout(() => removeNoti(noti), 3000)
        };

          // Tao remove toast

          const removeToast = (toast) => {
                toast.classList.add("hide");
                if (toast.timeoutId) clearTimeout(toast.timeoutId);
                setTimeout(() => toast.remove(), 400);
            };


            // Tao Toast
            
            function createToast(toastMessage) {
                const toast = document.createElement('li');
                toast.className = `toasts error`;
                toast.innerHTML = `
                <div class="column">
                    <i class="fa-solid fa-bug"></i>
                    <span>${toastMessage}</span>
                </div>
                <i class="fa-solid fa-x"></i>
                `
                notifications.appendChild(toast);
                setTimeout(() => removeToast(toast), 3000)
            };

        const submenu = document.querySelectorAll('.has_child .icon_small');
        submenu.forEach((menu) => menu.addEventListener('click', togglePage));

        function togglePage(e) {
            e.preventDefault();
            submenu.forEach((item) => item != this ? item.closest('.has_child').classList.remove('expand') : null);
            if (this.closest('.has_child').classList != 'expand');
            this.closest('.has_child').classList.toggle('expand');
        }

        // Search

        const search = document.getElementById('search_product');
        const search_result = document.querySelector('.search_results');
        const searchURL = `http://127.0.0.1:8000/search`;

        searchProduct();

        // Lấy Value ở ô input

        function searchProduct() {
            search.addEventListener('keyup', function(e) {
                if (e.target.value) {
                    send(e.target.value.trim());
                    search_result.style.display = 'block';
                } else {
                    search_result.style.display = 'none';
                }
            })

            document.addEventListener('click', (e) => {
                if (e.target != search_result) {
                    search_result.style.display = "none";
                }
            })
        }

        // Search dữ liệu

        async function send(data) {
            const res = await fetch(`${searchURL}?data=${data}`)
                .then((response) => response.json())
                .then((data) => {
                    show(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }

        // Show Data

        function show(data) {
            console.log(data.results);
            if (data.results.length > 0) {
                let output = '';
                data.results.slice(0, 5).map(function(item) {
                    if (item.sale == 0) {
                        item.images.slice(0, 1).map((image) => {
                            output += `
                            <a href="{{ url('detail/${item.id}') }}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0,30)}</span>
                        </li>
                            </a>
                        `
                        });
                    } else {
                        item.images.slice(0, 1).map((image) => {
                            output += `
                            <a href="{{ url('pageoffer/${item.id}') }}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0,50)}</span>
                        </li>
                            </a>
                        `
                        });
                    }
                });
                search_result.innerHTML = output;
            } else {
                search_result.innerHTML = '<li> <span> Không tìm thấy sản phẩm </span></li>';
            }
        }


        // wishlist
        async function wishlist(id, userID) {

            const res = await fetch(`http://127.0.0.1:8000/wishlist/store/${id}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: id,
                        user_id: userID,
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    console.log(data.result);
                    message = 'Đã thêm vào danh sách yêu thích';
                    createNoti(message);
                    let wishlist_number = document.querySelector('#wishlist_number');
                    wishlist_number.innerText = data.result.length;
                    let wishlist_love = document.querySelector('#wish_love');
                    let content = '';
                    data.result.slice(0, 1).map((item) => {
                        content += `
                        <li>
                        <a href="#" id="wishlist" onclick="wishlistDelete(${item.id},${item.product_id})">
                          <span class="icon_large" style="color: #ff6b6b"><i class="ri-heart-fill"></i></span>
                         <span id="love" style="color:#ff6b6b">Đã yêu thích</span>
                          </a>
                        </li>
                        <li>
                        <a href="">
                         <span class="icon_large"><i class="ri-share-line"></i></span>
                         <span>Chia sẻ</span>
                         </a>
                         </li>
                        `;
                    });
                    wishlist_love.innerHTML = content;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

            return false;

        }

        async function wishlistDelete(id, productID, userID) {
            const res = await fetch(`http://127.0.0.1:8000/wishlist/destroy/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },

                }).then((response) => response.json())
                .then((data) => {
                    let wishlist_number = document.querySelector('#wishlist_number');
                    wishlist_number.innerText = data.result.length;
                    let wishlist_love = document.querySelector('#wish_love');
                    let content = '';
                    content += `
                        <li>
                          <a href="#" id="wishlist" onclick="wishlist(${productID},${userID})">
                          <span class="icon_large"><i class="ri-heart-line"></i></span>
                          <span id="love" >Yêu thích</span>
                          </a>
                         </li> 
                        <li>
                        <a href="">
                         <span class="icon_large"><i class="ri-share-line"></i></span>
                         <span>Chia sẻ</span>
                         </a>
                         </li>
                        `;
                    wishlist_love.innerHTML = content;
                    message = 'Đã xóa khỏi danh sách yêu thích';
                    createNoti(message);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

            return false;
        }


        // add to Cart

        function addCart(id) {
            let colorRadio = document.getElementsByName('color');
            for (let i of colorRadio) {
                if (i.checked) {
                    var color = i.value;
                }
            }
            let sizeRadio = document.getElementsByName('size');
            for (let i of sizeRadio) {
                if (i.checked) {
                    var size = i.value;
                }
            }
            let quantity = document.querySelector("input[name='stock']").value;
            if (color == undefined && size == undefined) {
                message = "Phải chọn color và size";
                createNoti(message);
            } else if (size == undefined) {
                message = "Phải chọn size";
                createNoti(message);
            } else if (color == undefined) {
                message = "Phải chọn color";
                createNoti(message);
            }
            sendCart(id, color, size, quantity)
            console.log(id, color, size, quantity)
            return false;
        }

        async function sendCart(id, color, size, quantity) {
            const res = await fetch(`http://127.0.0.1:8000/cart/${id}`, {

                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: JSON.stringify({
                        color: parseInt(color),
                        size: parseInt(size),
                        quantity: parseInt(quantity),
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    showCart(data);
                    message = "Đã thêm vào giỏ hàng";
                    createNoti(message)
                    let form_cart = document.querySelector('#form_cart');
                    console.log(form_cart);
                    form_cart.reset();
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }

        // remove cart
        if( document.querySelector('#item_remove')){
            document.querySelector('#item_remove').addEventListener('click', (e) => {
                e.preventDefault();
            });
        }

        async function removeCart(id) {
            const res = await fetch(`http://127.0.0.1:8000/removecart/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    showCart(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }

        function showCart(data) {
            console.log(data);
            let render = '';
            let card_render = '';
            let item_number = document.querySelector('#item_number');
            item_number.innerText = data.cart.length;
            data.cart.map((cart) => {
                if (cart.product.discount) {
                    var price = (cart.product.price - (cart.product.price * ((cart.product.discount) / 100))) * cart
                        .quantity
                } else {
                    var price = cart.product.price * cart.quantity
                };
                render += `
                                        <li class="item" style="margin-bottom: 1em">
                                            ${
                                                (()=>{
                                                    if((cart.product.sale) == 0){
                                                        return `
                                                                <div class="thumbnail object_cover">
                                                                    <a href="{{ url('detail/${cart.product.id}') }}"><img src="${cart.image}"></a>
                                                                </div>
                                                                <div class="item_content">
                                                                    <p><a href="{{ url('detail/${cart.product.id}') }}">${(cart.product.name).substring(0,30)}</a>
                                                                    </p>       
                                                                            `
                                                    }else{
                                                         return ` 
                                                            <div class="thumbnail object_cover"> 
                                                                <a href="{{ url('pageoffer/${cart.product.id}')}}">
                                                                    <img src="${cart.image}">
                                                                </a>  
                                                            </div> 
                                                            <div class="item_content">
                                                                <p>
                                                                <a href="{{url('pageoffer/${cart.product.id}')}}">
                                                                    ${(cart.product.name).substring(0, 30)}
                                                                 </a> 
                                                                </p >
                    `
                                                    }
                                                })()
                                            }
                                                <span class="price">
                                                    <span>${price.toLocaleString('vi-VN')} VND</span>
                                                    <span class="fly_item"><span>${cart.quantity}x</span></span>
                                                </span>
                                            </div>
                                            <a href="#" class="item_remove" id="item_remove" onclick="removeCart(${cart.product.id})">
                                                    <i class="ri-close-line" ></i>
                                                </a>  
                                        </li>
            `;
                let ship = (15000 * data.cart.length).toLocaleString('vi-VN');
                console.log(data.cart.length)
                const caculator = data.cart.reduce((total, cartItem) => {
                    if (cart.product.discount) {
                        return total + cartItem.quantity * (cartItem.product.price - ((cartItem.product
                            .price) * ((cartItem.product.discount) / 100)));
                    } else {
                        return total + cartItem.quantity * (cartItem.product.price);
                    }
                }, 0);
                let total = caculator.toLocaleString('vi-VN')

                card_render = `
                                            <p>Phí ship</p>
                                            <p><strong> ${(15000).toLocaleString('vi-VN')} * ${data.cart.length} = ${ship}  VND</strong></p>
                                            <p>Tổng tiền</p>
                                            <p><strong>${(caculator + (15000 * data.cart.length)).toLocaleString('vi-VN')}
                                                    VND</strong></p>
                                        `
            })

            document.querySelector('#subtotal').innerHTML = card_render;
            document.querySelector('#card_body').innerHTML = render;
            document.querySelector('#card_head').innerText = `Có ${data.cart.length} sản phẩm`;
            if(data.cart.length > 0) {
                document.querySelector('.checkout_page').innerHTML = `
                <a href="http://127.0.0.1:8000/checkout" class="primary_button">CheckOut</a>
                `;
            }else{
                document.querySelector('.checkout_page').innerHTML = `
                <a href="#" onclick="createToast('Bạn cần có đơn hàng hoặc đăng nhâp')" class="primary_button">CheckOut</a>
                `;
            }
        };

    </script>
    @if (Session::has('success') || Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                function removeToast(toast) {
                    toast.classList.add("hide");
                    if (toast.timeoutId) clearTimeout(toast.timeoutId);
                    setTimeout(() => toast.remove(), 400);
                }

                setTime();

                function setTime() {
                    setTimeout(() => removeToast(toast), 3000)
                }
            });
        </script>
    @endif
    @if (Auth::check())
        <script>
            let profileDropdownList = document.querySelector(".profile-dropdown-list");
            let btn = document.querySelector(".profile-dropdown-btn");

            let classList = profileDropdownList.classList;

            const toggle = () => classList.toggle("active");

            window.addEventListener("click", function(e) {
                if (!btn.contains(e.target)) classList.remove("active");
            });
        </script>
    @endif

    @section('javascript')
    @show
</body>

</html>
