@extends('user.layout')
@section('title')
    Chi tiết sản phẩm {{ Illuminate\Support\Str::of($products->name)->words(4) }}
@endsection
@section('content')
    <ul class="notification">
    </ul>
    <div class="single_product page_single">
        <div class="container">
            <div class="wrapper">

                {{-- Mẩu bánh mì :)))) --}}

                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>{{ $products->name }}</li>
                    </ul>
                </div>

                {{-- Product --}}

                <div class="column">
                    <div class="products one">
                        <div class="flexwrap">
                            <div class="row">
                                <div class="item is_sticky">
                                    @if ($products->discount)
                                        <div class="price">
                                            <span class="discount"
                                                style="background-color: #bd7f7f">{{ $products->discount }}%<br>Giảm</span>
                                        </div>
                                    @endif
                                    <div class="big_image">
                                        <div class="big_image_wrapper swiper-wrapper">
                                            @foreach ($products->images as $image)
                                                <div class="image_show swiper-slide">
                                                    <a data-fslightbox href="{{ $image->path }}"><img
                                                            src="{{ $image->path }}" alt="{{ $products->name }}"></a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                    <div class="small_image">
                                        <ul class="small_image_wrapper flexitem swiper-wrapper">
                                            @foreach ($products->images as $image)
                                                <li class="thumbnail_show swiper-slide">
                                                    <img src="{{ $image->path }}" alt="{{ $products->name }}">"
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <h1>{{ $products->name }}</h1>

                                    <div class="content">
                                        <div class="rating">
                                            <div class="stars" style="width:{{ 80 * ($rate / 5) }}px "></div>
                                            <a href=""
                                                class="mini_text render_count">{{ $products->reviews->count() }}
                                                review</a>
                                        </div>
                                        <div class="price">
                                            @if ($products->discount)
                                                <span
                                                    class="current">{{ number_format(floor($products->price - ($products->price * $products->discount) / 100)) }}
                                                    VND</span>
                                                <span class="normal mini_text">{{ number_format($products->price) }}
                                                    VND</span>
                                            @else
                                                <span class="current">{{ number_format($products->price) }} VND</span>
                                            @endif
                                        </div>
                                        <div class="stock mini_text" data-stock="172">
                                            <div class="qty">
                                                <span>Đã bán<strong class="qty_sold">
                                                        160</strong></span>
                                                <span>Còn lại<strong class="qty_available">
                                                        {{ $products->stock }}</strong></span>
                                            </div>
                                            <div class="bar">
                                                <div class="available"></div>
                                            </div>
                                        </div>
                                        <div class="offer">
                                            <p>Offer hết hạn vào </p>
                                            <ul class="flexcenter">
                                                <li class="days"></li>
                                                <li class="hours"></li>
                                                <li class="minutes"></li>
                                                <li class="seconds"></li>
                                            </ul>
                                        </div>
                                        <form action="{{ url('cart/' . $products->id) }}" method="POST" id="form_cart">
                                            @csrf
                                            <div class="colors">
                                                <p>Color</p>
                                                <div class="variant">
                                                    @foreach ($products->attributevalues as $color)
                                                        @if ($color->attribute_id == 2)
                                                            <P>
                                                                <input type="radio" name="color"
                                                                    id="{{ $color->value }}" value="{{ $color->id }}">
                                                                <label for="{{ $color->value }}" class="circle size_bf"
                                                                    style="top:0; left:0; --bg:{{ $color->value }} "></label>
                                                            </P>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="sizes">
                                                <p>Size</p>
                                                <div class="variant">

                                                    @foreach ($products->attributevalues as $size)
                                                        @if ($size->attribute_id == 1)
                                                            <P>
                                                                <input type="radio" name="size"
                                                                    id="{{ $size->value }}" value="{{ $size->id }}">
                                                                <label for="{{ $size->value }}" class="circle size_bf"
                                                                    style="top:0; left:0;"><span>{{ $size->value }}</span></label>
                                                            </P>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="qty_control flexitem">
                                                    <div class="minus circle">-</div>
                                                    <input type="number" id="stock" value="1" name="stock"
                                                        min="1" max="{{ $products->stock }}">
                                                    <div class="plus circle">+</div>
                                                </div>
                                                <div class="button_cart">
                                                    <button class="primary_button" id="addtocart"
                                                        onclick="addCart({{ $products->id }})">Add to cart</button>
                                                </div>
                                        </form>
                                        <div class="wish_share">
                                            <ul class="flexitem second_links" id="wish_love">
                                                @if (Auth::check())
                                                @if ($products->wishlist)
                                                <li >
                                                    <a href="#" id="wishlist" onclick="wishlistDelete({{$products->wishlist->id}},{{$products->id}},{{Auth::user()->id}})">
                                                        <span class="icon_large" style="color: #ff6b6b"><i class="ri-heart-fill"></i></span>
                                                        <span id="love" style="color: #ff6b6b">Đã yêu thích</span>
                                                    </a>
                                                </li> 
                                                @else 
                                                <li>
                                                    <a href="#" id="wishlist" onclick="wishlist({{$products->id}},{{Auth::user()->id}})">
                                                        <span class="icon_large"><i class="ri-heart-line"></i></span>
                                                        <span id="love">Yêu thích</span>
                                                    </a>
                                                </li>   
                                                @endif
                                                @else
                                                <li>
                                                    <div id="wishlist" onclick="createToast('Bạn phải đăng nhập')" style="cursor: pointer">
                                                        <span class="icon_large"><i class="ri-heart-line"></i></span>
                                                        <span id="love">Yêu thích</span>
                                                    </div>
                                                </li> 
                                                @endif
                                                <li>
                                                    <a href="">
                                                        <span class="icon_large"><i class="ri-share-line"></i></span>
                                                        <span>Chia sẻ</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="descripition collapse">
                                        <ul>
                                            <li class="has_child expand ">
                                                <a href="#" class="icon_small">Thông tin sản phẩm</a>
                                                <div class="content">
                                                    <ul>
                                                        <li><span>Brand:</span><a
                                                                href=""><span>{{ $products->brand->name }}</span></a>
                                                        </li>
                                                        <li><span>Category:</span>
                                                            @foreach ($products->categories as $category)
                                                                <a href="#">
                                                                    <span>{{ $category->name }},</span></a>
                                                            @endforeach
                                                        </li>
                                                        <li><span>Số lượng: </span><span>{{ $products->stock }}</span>
                                                        </li>
                                                        <li><span>Đã bán:</span><span>160</span></li>
                                                        <li><span>Đánh giá:</span><span>160</span></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="has_child">
                                                <a href="#0" class="icon_small">Giới thiệu sản phẩm</a>
                                                <div class="content">
                                                    <p>{{ $products->desce }}</p>
                                                </div>
                                            </li>
                                            <li class="has_child">
                                                <a href="#0" class="icon_small">Bảng size </a>
                                                <div class="content">
                                                    <div class="table">
                                                        <table style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Size</th>
                                                                    <th><span class="mini_text">Rộng</span>(cm)</th>
                                                                    <th><span class="mini_text">Eo</span>(cm)</th>
                                                                    <th><span class="mini_text">Hông</span>(cm)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>S</td>
                                                                    <td>82.5</td>
                                                                    <td>62.5</td>
                                                                    <td>87.5</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>M</td>
                                                                    <td>85</td>
                                                                    <td>63.5</td>
                                                                    <td>89</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>L</td>
                                                                    <td>87.5</td>
                                                                    <td>67.5</td>
                                                                    <td>93</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XL</td>
                                                                    <td>90</td>
                                                                    <td>72.5</td>
                                                                    <td>98</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XXL</td>
                                                                    <td>93</td>
                                                                    <td>77.5</td>
                                                                    <td>103</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has_child">
                                                <a href="#" class="icon_small">Đánh giá<span
                                                        class="mini_text render_count">{{ $products->reviews->count() }}</span></a>
                                                <div class="content">
                                                    <div class="reviews">
                                                        <h4>Bình luận của mọi người</h4>
                                                        <div class="review_block">
                                                            <div class="review_block_head">
                                                                <div class="flexitem">
                                                                    <span class="rate_sum">{{ round($rate, 1) }}
                                                                        sao</span>
                                                                    <span class="render_count">Trên
                                                                        {{ $products->reviews->count() }} đánh
                                                                        giá</span>
                                                                </div>
                                                                @if (Auth::check())
                                                                    <a href="#review_form" class="secondary_button">Viết
                                                                        bình luận</a>
                                                                @else
                                                                    <a href="#" class="secondary_button"
                                                                        id="review_btn">Viết bình luận
                                                                @endif
                                                                </a>
                                                                <div class="review_block_body">
                                                                    <ul id="review_ul">

                                                                        @foreach ($products->reviews()->orderBy('created_at', 'desc')->limit(6)->get() as $review)
                                                                            <li class="item">
                                                                                <div class="review_form">
                                                                                    <p class="person">Bình luận bởi
                                                                                        {{ $review->name }}
                                                                                    </p>
                                                                                    <p class="mini_text">Vào ngày
                                                                                        {{ date('d-m-y'), strtotime($review->created_at) }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="review_rating rating">
                                                                                    <div class="stars"
                                                                                        style="width: {{ 80 * ($review->rate / 5) }}px">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="review_img object_cover">
                                                                                    @if ($review->image)
                                                                                        <img src="{{ asset('' . $review->image) }}"
                                                                                            style="position: static;width:200px;height:200px">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="review_title">
                                                                                    <p>{{ $review->title }}</p>
                                                                                </div>
                                                                                <div class="review_text">
                                                                                    <p>{{ $review->content }}</p>
                                                                                </div>
                                                                                @if (Auth::check())
                                                                                    @if (Auth::user()->name === $review->name || Auth::user()->role_id == 2)
                                                                                        <div
                                                                                            style="display:flex; gap:1em;">
                                                                                            <button class="primary_button"
                                                                                                style="border: none;outline:none"
                                                                                                id="btn_edit"
                                                                                                onclick="sendEdit({{$review->id}})">Sửa</button>
                                                                                            <button type="submit"
                                                                                                class="secondary_button"
                                                                                                id="btn_delete"
                                                                                                style="border:none; outline:none"
                                                                                                onclick="sendDelete({{ $review->id }})">
                                                                                                Xóa </button>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="second_links">
                                                                        <a href="#" class="view_all">
                                                                            Xem tất cả bình luận
                                                                            <i class="ri-arrow-right-line"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @if (Auth::check())
                                                                    <div id="review_form" class="review_form">
                                                                        <h4>Viết bình luận của bạn</h4>
                                                                        <div class="form_review_user">
                                                                            <form class="user_review"
                                                                                action="{{ url('/review/store/' . $products->id) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="rating">
                                                                                    <p>Bạn có thấy hài lòng?</p>
                                                                                    <div class="rate_this"
                                                                                        style="margin-bottom: 23px">
                                                                                        <input type="radio"
                                                                                            name="rate" id="star5"
                                                                                            value="5">
                                                                                        <label for="star5"><i
                                                                                                class="ri-star-fill"></i></label>
                                                                                        <input type="radio"
                                                                                            name="rate" id="star4"
                                                                                            value="4">
                                                                                        <label for="star4"><i
                                                                                                class="ri-star-fill"></i></label>
                                                                                        <input type="radio"
                                                                                            name="rate" id="star3"
                                                                                            value="3">
                                                                                        <label for="star3"><i
                                                                                                class="ri-star-fill"></i></label>
                                                                                        <input type="radio"
                                                                                            name="rate" id="star2"
                                                                                            value="2">
                                                                                        <label for="star2"><i
                                                                                                class="ri-star-fill"></i></label>
                                                                                        <input type="radio"
                                                                                            name="rate" id="star1"
                                                                                            value="1">
                                                                                        <label for="star1"><i
                                                                                                class="ri-star-fill"></i></label>
                                                                                    </div>
                                                                                </div>
                                                                                <p>
                                                                                    <label>Tiêu đề</label>
                                                                                    <input type="text" name="title"
                                                                                        required>
                                                                                </p>
                                                                                <p>
                                                                                    <label>Ảnh review</label>
                                                                                    <input type="file" name="image">
                                                                                </p>
                                                                                <p>
                                                                                    <label>Bình luận</label>
                                                                                    <textarea cols="30" rows="10" name="content" required></textarea>
                                                                                </p>
                                                                                <p>
                                                                                    <input type="text" hidden
                                                                                        name="name"
                                                                                        value="{{ Auth::user()->name }}">
                                                                                    <input type="text" hidden
                                                                                        name="email"
                                                                                        value="{{ Auth::user()->email }}">
                                                                                </p>
                                                                                <button id="button_review" type="submit"
                                                                                    class="primary_button"
                                                                                    style="border:none; outline:none">Bình
                                                                                    luận</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sản phẩm liên quan --}}

            <div class="related_products" style="background: transparent ;margin-top: 5em">
                <div class="container">
                    <div class="wrapper">
                        <div class="column">
                            <div class="sectop flexitem">
                                <h2><span class="circle"></span><span>Sản phẩm liên quan</span></h2>
                                <div class="second_links"><a href="" class="view_all">Xem tất cả<i
                                            class="ri-arrow-right-line"></i></a></div>
                            </div>
                            <div class="products main flexwrap">
                                @foreach (App\Models\admin\Product::where('sale', '=', 1)->where('id', '!=', $products->id)->inRandomOrder()->limit(6)->get() as $product)
                                    <div class="item">
                                        <div class="media">
                                            <div class="thumbnail object_cover">
                                                <a href="{{ url('pageoffer/' . $product->id) }}">
                                                    <img src="{{ $product->images->first()->path }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="hoverable">
                                                <ul>
                                                    <li class="active"><a href=""><i
                                                                class="ri-heart-line"></i></a></li>
                                                    <li><a href="{{ url('pageoffer/' . $product->id) }}"><i
                                                                class="ri-eye-line"></i></a></li>
                                                    <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                                </ul>
                                            </div>
                                            @if ($product->discount)
                                                <div class="discount circle flexcenter">
                                                    <span>{{ $product->discount }}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <div class="offer flexitem">
                                                <p>Offer hết hạn vào </p>
                                                <ul class="flexcenter">
                                                    <li class="days"></li>
                                                    <li class="hours"></li>
                                                    <li class="minutes"></li>
                                                    <li class="seconds"></li>
                                                </ul>
                                            </div>
                                            <div class="rating">
                                                <div class="stars"></div>
                                                <div class="mini_text">(160)</div>
                                            </div>
                                            <h3 class="main_links"><a
                                                    href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                                            </h3>
                                            <div class="price">
                                                @if ($product->discount)
                                                    <span
                                                        class="current">{{ number_format(floor($product->price - ($product->price * $product->discount) / 100)) }}
                                                        VND</span>
                                                    <span class="normal mini_text">{{ number_format($product->price) }}
                                                        VND</span>
                                                @else
                                                    <span class="current">{{ number_format($product->price) }}
                                                        VND</span>
                                                @endif
                                            </div>
                                            <div class="stock mini_text" data-stock="172">
                                                <div class="qty">
                                                    <span>Đã bán<strong class="qty_sold">
                                                            160</strong></span>
                                                    <span>Còn lại<strong class="qty_available">
                                                            {{ $products->stock }}</strong></span>
                                                </div>
                                                <div class="bar">
                                                    <div class="available"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('javascript')
    @if (Auth::check())
        <script>


    

            // comment
            const btn_review = document.querySelector('#button_review');
            const form_review = document.querySelector('.user_review');
            btn_review.addEventListener('click', (e) => {
                e.preventDefault();
                let title = document.querySelector('input[name="title"]').value;
                let image = document.querySelector('input[name="image"]').files[0];
                let content = document.querySelector('textarea[name="content"]').value;
                let rate = document.querySelector('input[name="rate"]').value;
                let name = document.querySelector('input[name="name"]').value;
                let email = document.querySelector('input[name="email"]').value
                sendData(name, email, rate, title, image, content);
                message = "Đã thêm bình luận"
                createNoti(message);
            })

            // Create review

            async function sendData(name, email, rate, title, image, content) {
                let form = new FormData();
                let dataReview = {
                    'name': `${name}`,
                    'email': `${email}`,
                    'rate': rate,
                    'title': `${title}`,
                    'content': `${content}`,
                }
                form.append('name', `${name}`);
                form.append('email', `${email}`);
                form.append('rate', rate);
                form.append('title', `${title}`);
                form.append('content', `${content}`);
                form.append('image', image);
                const res = await fetch(`http://127.0.0.1:8000/review/store/{{ $products->id }}`, {
                        method: "POST",
                        // headers: {
                        //     "Content-Type": "application/json",
                        //     "X-Requested-With": "XMLHttpRequest",
                        // },
                        body: form,
                    }).then((response) => response.json())
                    .then((data) => {
                        showData(data);
                    })
                    .catch((error) => {
                        alert(error.message);
                    });
            }

            // delete review

            let btn_delete = document.querySelector('#btn_delete');

            async function sendDelete(id) {
                const res = await fetch(`http://127.0.0.1:8000/review/destroy/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        showData(data);
                    })
                    .catch((error) => {
                        alert(error.message);
                    });

                message = "Đã xóa bình luận";
                createNoti(message);

                return false;
            }

            // Edit comment

            async function sendEdit(id) {
                const res = await fetch(`http://127.0.0.1:8000/review/edit/${id}`)
                    .then((response) => response.json())
                    .then((data) => {
                        createForm(data);
                    })
                    .catch((error) => {
                        alert(error.message);
                    });
            };

            function createForm(data) {
                console.log(data.result.content);
                let form_review_user = document.querySelector('.form_review_user');
                form_review.style.display = 'none';
                let new_form = `
                <form class="user_review" method="POST" enctype="multipart/form-data">
                     @csrf
                      <div class="rating">
                      <p>Bạn đã đánh giá sản phẩm này là ${data.result.rate} sao</p>
                      <p>Bạn có muốn đánh giá lại?</p>
                        <div class="rate_this" style="margin-bottom: 23px">
                            <input type="radio" name="rate" id="star5" value="5">
                            <label for="star5"><i class="ri-star-fill"></i></label>
                            <input type="radio" name="rate" id="star4" value="4">
                            <label for="star4"><i class="ri-star-fill"></i></label>
                            <input type="radio" name="rate" id="star3" value="3">
                            <label for="star3"><i class="ri-star-fill"></i></label>
                            <input type="radio" name="rate" id="star2" value="2">
                            <label for="star2"><i class="ri-star-fill"></i></label>
                            <input type="radio" name="rate" id="star1"  value="1">
                            <label for="star1"><i class="ri-star-fill"></i></label>
                            </div>
                        </div>
                              <p>
                             <label>Tiêu đề</label>
                              <input type="text" name="title" required value="${data.result.title}">
                            </p>
                            <p>
                            Ảnh review trước đó: 
                            <img src="{{ asset('${data.result.image}') }}" style="position: static;width:200px;height:200px">    
                            </p>
                           <p>
                           <label>Ảnh review <small>(Nếu muốn đổi)</small>)</label>
                        <input type="file" name="image" value="${data.result.file}">
                         </p>
                        <p>
                        <label>Bình luận</label>
                        <input cols="30" rows="10" name="content" required value="${data.result.content}"></input>
                         </p>
                        <p>
                         <input type="text" hidden name="name" value="${data.result.name}">
                         <input type="text" hidden name="email" value="${data.result.email}">
                         </p>
                         <button id="button_review" type="submit" class="primary_button"
                         style="border:none; outline:none">Bình luận</button>
                         </form>                          
                                                                                        
                `;
                form_review_user.innerHTML = new_form;
            }


            async function sendData(id, name, email, rate, title, image, content) {
                let form = new FormData();
                let dataReview = {
                    'name': `${name}`,
                    'email': `${email}`,
                    'rate': rate,
                    'title': `${title}`,
                    'content': `${content}`,
                }
                form.append('name', `${name}`);
                form.append('email', `${email}`);
                form.append('rate', rate);
                form.append('title', `${title}`);
                form.append('content', `${content}`);
                form.append('image', image);
                const res = await fetch(`http://127.0.0.1:8000/review/update/${id}`, {
                        method: "PATCH",
                        // headers: {
                        //     "Content-Type": "application/json",
                        //     "X-Requested-With": "XMLHttpRequest",
                        // },
                        body: form,
                    }).then((response) => response.json())
                    .then((data) => {
                        showData(data);
                    })
                    .catch((error) => {
                        alert(error.message);
                    });
            }


            function showData(data) {

                let show = '';
                let review_ul = document.querySelector('#review_ul');

                let count_render = data.result.filter((item) => {
                    return item.product_id == {{ $products->id }}
                });


                let sort = count_render.sort(function(a, b) {
                    return b.id - a.id;
                });
                sort.slice(0, 6).map((item) => {
                    console.log(item);
                    let date = new Date(item.created_at);
                    let time = (date.getDate()) +
                        '-' + (date.getMonth()) +
                        '-' + date.getFullYear()
                    console.log(item);
                    show += `
                <li class="item">
                   <div class="review_form">
                     <p class="person">Bình luận bởi ${item.name} </p>
                     <p class="mini_text">Vào ngày ${time} </p>
                   </div>
                <div class="review_rating rating">
                 <div class="stars" style="width: { 80 * (${item.rate} / 5) }px">
                 </div>
                  </div>
                   ${
                    (()=>{
                        if(item.image){
                            return `
                                    <div class="review_img object_cover">
                                        <img src="{{ asset('${item.image}') }}" style="position: static;width:200px;height:200px">
                                    </div>
                                    `
                        }else{
                            return `
                    `
                        }
                    })()
                   };
                     <div class="review_title">
                     <p>${item.title}</p>
                     </div>
                     <div class="review_text">
                      <p>${item.content}</p>
                      </div>
                      ${
                        (()=>{
                            if(item.name == '{{ Auth::user()->name }}' || {{ Auth::user()->role_id }}==2){
                                return `
                                        <div style="display:flex; gap:1em;">
                                            <button class="primary_button" style="border: none;outline:none" id="btn_edit"
                                             onclick="sendEdit(this)">Sửa</button>
                                             <button type="submit" class="secondary_button" id="btn_delete" style="border:none; outline:none" onclick="sendDelete(${item.id})"> Xóa </button>
                                        </div>
                                        `;
                            }else{
                                return `
                    `
                            }
                        })()
                      };
                 </li>
                `;
                });
                review_ul.innerHTML = show;
                let render_count = document.querySelectorAll('.render_count');
                for (let i of render_count) {
                    i.innerText = count_render.length + ' reviews';
                }
                // reset Form 

                form_review.reset();
            }
        </script>
    @endif

    <script>
        const addToCart = document.querySelector('#addtocart');

        addToCart.addEventListener('click', (e) => {
            e.preventDefault();
        })

        const dpt_menu = document.querySelector('.dpt_menu');
        const close_menu = document.getElementById('close_menu');

        dpt_menu.classList.add('active');

        close_menu.addEventListener('click', (e) => {
            e.preventDefault();
            dpt_menu.classList.toggle('active');
        });

        // slider images

        var productThumb = new Swiper('.small_image', {
            loop: true,
            spaceBetween: 10,
            slidesPerview: 3,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                481: {
                    spaceBetween: 32,
                }
            }
        });

        var productBig = new Swiper('.big_image', {
            loop: true,
            autoHeight: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: productThumb,
            }
        });


        //Phần deal of day
        let countDate = new Date('29,JUN,2023 00:00:00').getTime();
        let day = document.querySelectorAll('.days')
        let minute = document.querySelectorAll('.minutes');
        let hour = document.querySelectorAll('.hours');
        let second = document.querySelectorAll('.seconds');

        function countDown() {
            let now = new Date().getTime();

            gap = countDate - now;

            let seconds = 1000;
            let minutes = seconds * 60;
            let hours = minutes * 60;
            let days = hours * 24;
            let d = Math.floor(gap / (days)) < 10 ? '0' + Math.floor(gap / (days)) : Math.floor(gap / days);
            let h = Math.floor((gap % (days)) / (hours)) < 10 ? '0' + Math.floor((gap % (days)) / (hours)) : Math.floor((
                gap %
                (days)) / (hours));
            let m = Math.floor((gap % (hours)) / (minutes)) < 10 ? '0' + Math.floor((gap % (hours)) / (minutes)) : Math
                .floor((gap % (hours)) / (minutes));
            let s = Math.floor((gap % (minutes)) / (seconds)) < 10 ? '0' + Math.floor((gap % (minutes)) / (seconds)) : Math
                .floor((gap % (minutes)) / (seconds));

            for (const i of day) {
                i.innerHTML = d;
            }
            for (const i of minute) {
                i.innerHTML = m;
            }
            for (const i of hour) {
                i.innerHTML = h;
            }
            for (const i of second) {
                i.innerHTML = s;
            }

        }
        setInterval(() => {
            countDown()
        }, 1000);

        let stocks = document.querySelectorAll('.products .stock');
        for (let i = 0; i < stocks.length; i++) {
            let stock = stocks[i].dataset.stock,
                avaiable = stocks[i].querySelector('.qty_available').innerHTML,
                sold = stocks[i].querySelector('.qty_sold').innerHTML,
                percent = sold * 100 / stock;

            stocks[i].querySelector('.available').style.width = percent + '%';
        };

        // Check stock
        let quantity = document.querySelector('#stock');
        let minus = document.querySelector('.minus');
        let plus = document.querySelector('.plus');

        minus.addEventListener('click', (e) => {
            let value = parseInt(quantity.value);
            if (value > 1) {
                value -= 1;
                quantity.value = value;
            }
        });

        plus.addEventListener('click', (e) => {
            let value = parseInt(quantity.value);
            if (value < {{ $products->stock }}) {
                value += 1;
                quantity.value = value;
            }

        });

        quantity.addEventListener('change', (e) => {
            if (e.target.value > {{ $products->stock }}) {
                e.target.value = {{ $products->stock }};
                quantity.value = {{ $products->stock }};
            }
        });
    </script>

    @if (!Auth::check())
        <script>
            const review_btn = document.querySelector('#review_btn');
            const notifications = document.querySelector('.notification');
            const timer = 3000;

            review_btn.addEventListener('click', (e) => {
                e.preventDefault();
                createToast();
                console.log(1);
            })

            // Tao remove toast

            const removeToast = (toast) => {
                toast.classList.add("hide");
                if (toast.timeoutId) clearTimeout(toast.timeoutId);
                setTimeout(() => toast.remove(), 400);
            };


            // Tao Toast
            let toastMessage = "Bạn phải đăng nhập mới được bình luận";
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
        </script>
    @endif
@endsection
