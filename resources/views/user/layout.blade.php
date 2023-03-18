<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/js/bootstrap.js') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/user.css') }}">
    <title>
        @section('title')
        @show
    </title>
</head>

<body>

    {{-- Navbar --}}

    <div class="header_nav">
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
                            <li>
                                <a href="#" id="shop_toggle">Shop
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
                                                            <li><a href="#">{{ $category->name }}</a></li>
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
                                                                <li><a href="#">{{ $category->name }}</a></li>
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
                                                                <li><a href="#">{{ $category->name }}</a></li>
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
                                                            @foreach ($categories->take(8) as $category)
                                                                <li><a href="#">{{ $category->name }}</a></li>
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
                                                                    alt="Ảnh model fashion">
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
                        <li class="mobile_hide"><a href="#">
                                <div class="icon_large" style="margin-top: -36px"><i class="ri-heart-line"></i>
                                    <div class="fly_item"><span class="item_number">0</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="iscart">
                                <div class="icon_large" style="margin-top: -36px"><i class="ri-shopping-cart-line"></i>
                                    <div class="fly_item"><span class="item_number">0</span></div>
                                </div>
                            </a>
                            {{-- <div class="mini_cart">
                                <div class="content">
                                    <div class="cart_head">
                                        Có ? đơn hàng
                                    </div>
                                        <div class="cart_body">
                                            <ul class="product mini">
                                                <li class="item">
                                                    <div class="thumbnail object_cover">
                                                        <a href="#"><img src="{{asset('images/home1.jpg')}}"></a>
                                                    </div>
                                                    <div class="item_content">
                                                        <p><a href="#">Name</a></p>
                                                        <span class="price">
                                                            <span>200</span>
                                                            <span class="fly_item"><span>2x</span></span>
                                                        </span>
                                                    </div>
                                                    <a href="" class="item_remove">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                            </div> --}}
                        </li>
                        <li>
                            @if (Auth::check())
                                <div class="auth login_user">
                                    <div class="auth_select">
                                        <button id="btn_auth">{{ Auth::user()->name }}<i class="ri-arrow-down-s-line"
                                                style="font-size:23px;position: absolute;right:1px"
                                                id="arrow_down"></i></button>
                                        <div class="select_user" id="select">
                                            <ul>
                                                <li>
                                                    <a href="#">Thông tin cá nhân</a>
                                                </li>
                                                @if (!(Auth::user()->role_id == 1))
                                                    <li>
                                                        <a href="{{ route('admin.dashboard.index') }}">Trang
                                                            Dashboard</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <form action="{{ url('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            style="border: none; outline:none; background-color:transparent;font-size:18px">Đăng
                                                            xuất</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="auth login">
                                    <a href="{{ route('login') }}" style="font-family: 'Rubik' ,sans-serif;">Đăng nhập</a>
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
                                    <ul style="background-image: url({{ asset('images/menu_bg1.jpg') }})">
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
                                <li class="has_child electronic">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-bluetooth-connect-line"></i></div>
                                        Electronic
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul style="background-image: url({{ asset('images/menu_bg2.jpg') }})">
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
                                <li class="has_child women">
                                    <a href="#" style="display: flex">
                                        <div class="icon_large"><i class="ri-t-shirt-air-line"></i></div>
                                        Women's Fashion
                                        <div class="icon_small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul style="background-image: url({{ asset('images/menu_bg3.jpg') }})">
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
                                    <div
                                        class="mega"style="background-image: url({{ asset('images/menu_bg4.jpg') }})">
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
                        <form action="" class="search">
                            <span class="icon_large"><i class="ri-search-line" style="margin-bottom:16px"></i></span>
                            <input type="search" placeholder="Tìm kiếm tên sản phẩm" name="search" id="search_product">
                            <button type="submit">Search</button>
                        </form>
                        <ul class="search_results">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_fashion">
        @section('content')
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
    
    <footer>
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
                <p class="mini_text">Copyright &copy; 2022 <strong><a href="{{url('/')}}">FASHION</a>.</strong> 
                    All rights reserved.</p>
            </div>
        </div>
       </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{asset('user/main.js')}}"></script>   --}}
    {{-- CDN Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- CDN jquery --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>

    <script>

        const submenu = document.querySelectorAll('.has_child .icon_small');
        submenu.forEach((menu)=> menu.addEventListener('click',toggle));

        function toggle(e) {
            e.preventDefault();
            submenu.forEach((item)=> item != this ? item.closest('.has_child').classList.remove('expand'):null);
            if(this.closest('.has_child').classList != 'expand');
            this.closest('.has_child').classList.toggle('expand');
        }

        const shop_toggle = document.getElementById('shop_toggle');
        const mega = document.querySelector('.mega');
        const arrow_shop = document.querySelector('#arrow_shop');

        // Xử lý sự kiến cho shop
        shop_toggle.addEventListener('click', () => {
            toggleShop();
        });

        function toggleShop() {
            mega.classList.toggle('active');
            arrow_shop.classList.toggle('active');

            // Xử lý sự kiện khi không click vào shop

            document.addEventListener('click', function(e) {
                if (e.target !== mega && e.target !== shop_toggle) {
                    mega.classList.remove('active');
                    arrow_shop.classList.remove('active');
                }
            });
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
                    sendData(e.target.value);
                    search_result.style.display = 'block';
                } else {
                    search_result.style.display = 'none';
                }
            })
        }

        // Search dữ liệu

        async function sendData(data) {
            const res = await fetch(`${searchURL}?data=${data}`)
                .then((response) => response.json())
                .then((data) => {
                    showData(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }

        // Show Data

        function showData(data) {
            console.log(data.results);
            if (data.results.length > 0) {
                let output = '';
                data.results.slice(0, 5).map(function(item) {
                    if(item.id>1){
                        item.images.slice(0,1).map((image) => {
                            output += `
                            <a href="{{url('detail/${item.id}')}}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0,30)}</span>
                        </li>
                            </a>
                        `
                        });
                    }else{
                        item.images.slice(0,1).map((image) => {
                            output += `
                            <a href="{{url('pageoffer/${item.id}')}}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0,30)}</span>
                        </li>
                            </a>
                        `
                    });
                }});
                search_result.innerHTML = output;
            } else {
                search_result.innerHTML = '<p>Không tìm thấy sản phẩm</p>';
            }
        } 
        
    </script>
     @if (Session::has('success') || Session::has('error'))
     <script>
         document.addEventListener('DOMContentLoaded', function() {
 
             const notifications = document.querySelector('.notification');
             const toast = document.querySelector('.toasts');
             const timer = 3000;
 
 
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
            const btn_auth = document.getElementById('btn_auth');
            const select = document.getElementById('select');
            const arrow_down = document.getElementById('arrow_down');

            // Toggle cho auth

            btn_auth.addEventListener('click', function() {
                toggleAuth();
            });

            function toggleAuth() {
                select.classList.toggle('active');
                arrow_down.classList.toggle('active');

                // Xử lý sự kiện khi không click vào shop

                document.addEventListener('click', function(e) {
                    if (e.target !== select && e.target !== btn_auth) {
                        select.classList.remove('active');
                        arrow_down.classList.remove('active');
                    }
                })
            };
        </script>
    @endif

    @section('javascript')
    @show
</body>

</html>
