<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/js/bootstrap.js') }}">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='icon' href='{{asset('images/logoCart.png')}}' type='image/x-icon'>

    <link rel="stylesheet" type="text/css" href="{{ asset('user/user.css') }}">
    <title>
        @section('title')
        @show
    </title>
</head>

<body>


{{--<div id="load-data">--}}
{{--    <div></div>--}}
{{--</div>--}}
@if (Session::has('success'))
    <ul class="notification">
        <li class="success toasts">
            <div class="column">
                <i class="fa fa-check"></i>
                <span>{{ session('success') }}</span>
            </div>
            <i class="fa fa-xmark close-toast"></i>
        </li>
    </ul>
@elseif (Session::has('error'))
    <ul class="notification">
        <li class="error toasts">
            <div class="column">
                <i class="fa fa-bug"></i>
                <span>{{ session('error') }}</span>
            </div>
            <i class="fa fa-xmark close-toast"></i>
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
                                                                     alt="logo"
                                                                     style="width:30px; height:30px; margin-right:5px"><span
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
                                                                         alt="logo"
                                                                         style="width:30px; height:30px; margin-right:5px"><span
                                class="circle"></span><span
                                style="font-family: 'Dancing Script', cursive; color:green">.F</span><span>ashion</span></a>
                    </div>
                    <nav class="mobile_hide">
                        <ul class="flexitem second_link">
                            <li><a href="{{ route('home') }}"
                                   class="active-link {{ request()->is('/') ? 'active' : '' }}">Trang chủ</a></li>
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
                                                            <li>
                                                                <a href="{{url('category/'. $category->slug)}}">{{ $category->name }}</a>
                                                            </li>
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
                                                                <li>
                                                                    <a href="{{url('category/'. $category->slug)}}">{{ $category->name }}</a>
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
                                                                <li>
                                                                    <a href="{{url('category/'. $category->slug)}}">{{ $category->name }}</a>
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
                                                                <li>
                                                                    <a href="{{url('brand/'.$brand->slug)}}">{{ $brand->name }}</a>
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
                            <li class="mobile_hide">
                                <a title="Lịch sử" href="{{ route('history') }}">
                                    <div class="icon_large" style="margin-top: -36px">
                                        <i class="ri-history-line"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="mobile_hide"><a title="Yêu thích" href="{{ url('/wishlist/' . Auth::user()->id) }}">
                                    <div class="icon_large" style="margin-top: -36px"><i
                                            class="ri-heart-line"></i>
                                        <div class="fly_item"><span class="item_number"
                                                                    id="wishlist_number">{{ App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li class="mobile_hide" style="cursor:pointer" onclick="createToast('Bạn cần phải đăng nhập')">
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
                            <a href="#" title="Giỏ hàng">
                                <div class="icon_large" id="cart_product"><i
                                        class="ri-shopping-cart-line"></i>
                                    <div class="fly_item"><span class="item_number"
                                                                id="item_number">{{ count($cart) }}</span></div>
                                </div>
                            </a>

                                <div class="mini_cart" id="mini_cart">
                                    @include('user.cart')
                                </div>

                        </li>
                        <li>

                            @if (Auth::check())
                                <div class="profile-dropdown">
                                    @can('confirm-shipper')
                                        <div class="fly_item" style="top:-10px;background:red">
                                                <span
                                                    class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', CONFIRM)->where('ship',NOT_SHIP)->count() }}
                                                </span>
                                        </div>
                                    @endcan

                                    @can('confirm-order')
                                        <div class="fly_item" style="top:-10px;background:red">
                                                <span
                                                    class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', NOT_CONFIRM)->count() }}
                                                </span>
                                        </div>
                                    @endcan
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
                                                @can('view-dashboard')
                                                    <li class="profile-dropdown-list-item">
                                                        <a href="{{ url('/admin/dashboard') }}">
                                                            <i class="ri-home-8-line"></i>
                                                            Trang dashboard
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('confirm-order')
                                                    <li class="profile-dropdown-list-item" style="position: relative">
                                                        <a href="{{ url('pageConfirm') }}">
                                                            <i class="ri-check-fill"></i>
                                                            Trang xác nhận đơn hàng
                                                        </a>
                                                        <div class="fly_item" style="top:-10px;background:red">
                                                        <span
                                                            class="item_number" id="count_number-confirm">{{ App\Models\OrderDetail::where('status', NOT_CONFIRM)->count() }}
                                                        </span>
                                                        </div>
                                                    </li>
                                                @endcan
                                                @cannot('confirm-shipper')
                                                <li class="profile-dropdown-list-item">
                                                    <a href="{{ url('shipper') }}">
                                                        <i class="ri-run-line"></i>
                                                        Đăng kí làm shipper
                                                    </a>
                                                </li>
                                                @endcannot
                                                @can('confirm-shipper')
                                                    <li class="profile-dropdown-list-item" style="position: relative">
                                                        <a href="{{ url('pageShip') }}">
                                                            <i class="ri-truck-line"></i>
                                                            Check đơn hàng
                                                        </a>
                                                        <div class="fly_item" style="top:-10px;background:red">
                                                     <span class="item_number" id="count_number-ship">{{ App\Models\OrderDetail::where('status', CONFIRM)->where('ship',NOT_SHIP)->count() }}
                                                     </span>
                                                        </div>
                                                    </li>
                                                @endcan
                                                <hr/>
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
                            <div class="mini_text mobile_hide">Tất cả {{ \App\Models\admin\Product::count()  }} sản
                                phẩm
                            </div>
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
                                <h4>Danh mục</h4>
                                <ul class="flexcol">
                                    @foreach(\App\Models\admin\Category::take(8)->get() as $cate)
                                        <li><a href="{{ url('category/'.$cate->slug) }}">{{ $cate->name }}</a></li>
                                    @endforeach
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
                                                               alt="logo"
                                                               style="width:30px; height:30px; margin-right:5px"><span
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@include('user.main')

@section('javascript')
@show
</body>

</html>
