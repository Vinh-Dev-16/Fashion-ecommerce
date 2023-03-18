@extends('user.layout')
@section('title')
    Chi tiết sản phẩm {{ Illuminate\Support\Str::of($products->name)->words(4) }}
@endsection
@section('content')
        <ul class="notification">
        </ul>
    <div class="single_product">
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
                                        <div class="stars"></div>
                                        <a href="" class="mini_text">160 review</a>
                                    </div>
                                    <div class="stock_sku">
                                        <span class="avaiable">Số lượng</span>
                                        <span class="sku mini_text">160</span>
                                    </div>
                                    <div class="price">
                                        @if ($products->discount)
                                            <span
                                                class="current">{{ number_format(floor($products->price - ($products->price * $products->discount) / 100)) }}
                                                VND</span>
                                            <span class="normal mini_text">{{ number_format($products->price) }} VND</span>
                                        @else
                                            <span class="current">{{ number_format($products->price) }} VND</span>
                                        @endif
                                    </div>
                                    <div class="colors">
                                        <p>Color</p>
                                        <div class="variant">
                                            <form action="">
                                                @foreach ($products->attributevalues as $color)
                                                    @if ($color->attribute_id == 2)
                                                        <P>
                                                            <input type="radio" name="color" id="{{ $color->value }}">
                                                            <label for="{{ $color->value }}" class="circle"
                                                                style="top:0; left:0; --bg:{{ $color->value }} "></label>
                                                        </P>
                                                    @endif
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                    <div class="sizes">
                                        <p>Size</p>
                                        <div class="variant">
                                            <form action="">
                                                @foreach ($products->attributevalues as $size)
                                                    @if ($size->attribute_id == 1)
                                                        <P>
                                                            <input type="radio" name="color" id="{{ $size->value }}">
                                                            <label for="{{ $size->value }}" class="circle"
                                                                style="top:0; left:0;">{{ $size->value }}</label>
                                                        </P>
                                                    @endif
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <div class="qty_control flexitem">
                                            <button class="minus circle">-</button>
                                            <input type="number" value="1" id="stock" name="stock">
                                            <button class="plus circle">+</button>
                                        </div>
                                        <div class="button_cart">
                                            <button class="primary_button">Add to cart</button>
                                        </div>
                                        <div class="wish_share">
                                            <ul class="flexitem second_links">
                                                <li>
                                                    <a href="">
                                                        <span class="icon_large"><i class="ri-heart-line"></i></span>
                                                        <span>Yêu thích</span>
                                                    </a>
                                                </li>
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
                                                        <li><span>Brand:</span><span>{{ $products->brand->name }}</span>
                                                        </li>
                                                        <li><span>Số lượng: </span><span>{{ $products->stock }}</span></li>
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
                                                        class="mini_text">16k</span></a>
                                                <div class="content">
                                                    <div class="reviews">
                                                        <h4>Bình luận của mọi người</h4>
                                                        <div class="review_block">
                                                            <div class="review_block_head">
                                                                <div class="flexitem">
                                                                    <span class="rate_sum">4.9</span>
                                                                    <span>2.251 bình luận</span>
                                                                </div>
                                                                @if (Auth::check())
                                                                <a href="#review_form" class="secondary_button"
                                                                >Viết bình luận</a> 
                                                                @else
                                                                <a href="#" class="secondary_button"
                                                                id="review_btn">Viết bình luận
                                                                @endif
                                                            </a>
                                                            <div class="review_block_body">
                                                                <ul>
                                                                    <li class="item">
                                                                        <div class="review_form">
                                                                            <p class="person">Bình luận bởi ABC </p>
                                                                            <p class="mini_text">Vào ngày 17/3/2023</p>
                                                                        </div>
                                                                        <div class="review_rating rating">
                                                                            <div class="stars">
                                                                            </div>
                                                                        </div>
                                                                        <div class="review_title">
                                                                            <p>Bình luận ABCXYZ</p>
                                                                        </div>
                                                                        <div class="review_text">
                                                                            <p>Lorem ipsum dolor sit amet consectetur
                                                                                adipisicing elit. Autem unde voluptatem
                                                                                illo, sed veritatis vero nobis beatae
                                                                                corrupti earum aliquam asperiores fuga quas,
                                                                                quis, eveniet id facilis delectus assumenda
                                                                                a!</p>
                                                                        </div>
                                                                    </li>
                                                                    <li class="item">
                                                                        <div class="review_form">
                                                                            <p class="person">Bình luận bởi ABC </p>
                                                                            <p class="mini_text">Vào ngày 17/3/2023</p>
                                                                        </div>
                                                                        <div class="review_rating rating">
                                                                            <div class="stars">
                                                                            </div>
                                                                        </div>
                                                                        <div class="review_title">
                                                                            <p>Bình luận ABCXYZ</p>
                                                                        </div>
                                                                        <div class="review_text">
                                                                            <p>Lorem ipsum dolor sit amet consectetur
                                                                                adipisicing elit. Autem unde voluptatem
                                                                                illo, sed veritatis vero nobis beatae
                                                                                corrupti earum aliquam asperiores fuga quas,
                                                                                quis, eveniet id facilis delectus assumenda
                                                                                a!</p>
                                                                        </div>
                                                                    </li>
                                                                    <li class="item">
                                                                        <div class="review_form">
                                                                            <p class="person">Bình luận bởi ABC </p>
                                                                            <p class="mini_text">Vào ngày 17/3/2023</p>
                                                                        </div>
                                                                        <div class="review_rating rating">
                                                                            <div class="stars">
                                                                            </div>
                                                                        </div>
                                                                        <div class="review_title">
                                                                            <p>Bình luận ABCXYZ</p>
                                                                        </div>
                                                                        <div class="review_text">
                                                                            <p>Lorem ipsum dolor sit amet consectetur
                                                                                adipisicing elit. Autem unde voluptatem
                                                                                illo, sed veritatis vero nobis beatae
                                                                                corrupti earum aliquam asperiores fuga quas,
                                                                                quis, eveniet id facilis delectus assumenda
                                                                                a!</p>
                                                                        </div>
                                                                    </li>
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
                                                                <div class="rating">
                                                                    <p>Bạn có thấy hài lòng?</p>
                                                                    <div class="rate_this">
                                                                        <input type="radio" name="rate_star"
                                                                            id="star5">
                                                                        <label for="star5"><i
                                                                                class="ri-star-fill"></i></label>
                                                                        <input type="radio" name="rate_star"
                                                                            id="star4">
                                                                        <label for="star4"><i
                                                                                class="ri-star-fill"></i></label>
                                                                        <input type="radio" name="rate_star"
                                                                            id="star3">
                                                                        <label for="star3"><i
                                                                                class="ri-star-fill"></i></label>
                                                                        <input type="radio" name="rate_star"
                                                                            id="star2">
                                                                        <label for="star2"><i
                                                                                class="ri-star-fill"></i></label>
                                                                        <input type="radio" name="rate_star"
                                                                            id="star1">
                                                                        <label for="star1"><i
                                                                                class="ri-star-fill"></i></label>
                                                                    </div>
                                                                </div>
                                                                <form class="user_review">
                                                                    <p>
                                                                        <label>Tiêu đề</label>
                                                                        <input type="text" name="title">
                                                                    </p>
                                                                    <p>
                                                                        <label>Bình luận</label>
                                                                        <textarea cols="30" rows="10"></textarea>
                                                                    </p>
                                                                    <button type="submit" class="primary_button" style="border:none; outline:none">Bình luận</button>
                                                                </form>
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


        // Check stock

        //     const stock = document.getElementById('stock');
        //     const minus = document.querySelector('.minus');
        //     const plus = document.querySelector('.plus');

        //     stock.addEventListener('click', (e) => {
        //       stockInput(e);
        //     })

        //     stock.addEventListener('keyup', (e) => {
        //         stockInput(e);
        //     });

        //    function stockInput(e){
        //     if (e.target.value > {{ $products->stock }}) {
        //             stock.value = {{ $products->stock }};
        //         } else if (e.target.value < 1) {
        //             stock.value = 1;
        //         } else {
        //             stock.value = e.target.value;
        //         }
        //         decrement(stock.value);
        //         increment(stock.value);
        //    }
        //    console.log(stock.value);
        //    function decrement(value){
        //         minus.addEventListener('click', (e) => {
        //             value-=1;
        //             value = e.target.value-- < 1 ? 1 : e.target.value;
        //         });
        //    }

        //     function increment(value){
        //         plus.addEventListener('click', (e) => {
        //         value +=1;
        //         value = e.target.value++ > {{ $products->stock }} ? {{ $products->stock }} : e.target.value;
        //         });
        //     }
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
        if(toast.timeoutId) clearTimeout(toast.timeoutId); 
        setTimeout(() => toast.remove(), 400);
    };


    // Tao Toast

    function createToast() {
        const toast = document.createElement('li');
        toast.className = `toasts error`;
        toast.innerHTML = `
          <div class="column">
            <i class="fa-solid fa-bug"></i>
            <span>Bạn phải đăng nhập mới được bình luận</span>
          </div>
          <i class="fa-solid fa-x"></i>
        `
        notifications.appendChild(toast);
        setTimeout(()=> removeToast(toast),3000)
    };

    </script>
    @endif
@endsection
