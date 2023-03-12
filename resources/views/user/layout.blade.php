<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/js/bootstrap.js') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/user.css') }}">
    <title>Trang chủ</title>
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
                            <li><a href="{{ route('home') }}">Home</a></li>
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
                            <li><a href="#">Woman</a></li>
                            <li><a href="#">Man</a></li>
                            <li><a href="#">Shoe</a></li>
                            <li style="position: relative"><a href="#">Bag
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
                                    <a href="{{ route('login') }}">Đăng nhập</a>
                                </div>
                            @endif
                        <li>
                    </ul>
                </div>
            </div>
            <div class="main">
                @section('content')
                @show
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> 
    <script src="{{asset('user/main.js')}}"></script>   --}}
    {{-- CDN Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- CDN jquery --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script>
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
                console.log(e.target);
            }
        });
        }

    </script>
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
</body>

</html>
