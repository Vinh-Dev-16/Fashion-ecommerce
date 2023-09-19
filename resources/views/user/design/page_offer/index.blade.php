@extends('user.layout')
@section('title')
    Chi tiết sản phẩm {{ Illuminate\Support\Str::of($product->name)->words(4) }}
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
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>

                {{-- Product --}}

                <div class="column">
                    <div class="products one">
                        <div class="flexwrap">
                            <div class="row">
                                <div class="item is_sticky">
                                    @if ($product->discount)
                                        <div class="price">
                                            <span class="discount"
                                                  style="background-color: #bd7f7f">{{ $product->discount }}%<br>Giảm</span>
                                        </div>
                                    @endif
                                    <div class="big_image">
                                        <div class="big_image_wrapper swiper-wrapper">
                                            @foreach ($product->images as $image)
                                                <div class="image_show swiper-slide">
                                                    <a data-fslightbox href="{{ $image->path }}"><img
                                                            src="{{ $image->path }}" alt="{{ $product->name }}"></a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                    <div class="small_image">
                                        <ul class="small_image_wrapper flexitem swiper-wrapper">
                                            @foreach ($product->images as $image)
                                                <li class="thumbnail_show swiper-slide">
                                                    <img src="{{ $image->path }}" alt="{{ $product->name }}">"
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <h1>{{ $product->name }}</h1>

                                    <div class="content">
                                        <div class="rating">
                                            @if (80 *
                                            ($product->reviews()->pluck('feedbacks.rate')->avg() /
                                                5) ==
                                            0)
                                                <div class="stars" style="background-image:none;width:150px">Chưa có
                                                    đánh giá
                                                </div>
                                            @else
                                                <div class="stars"
                                                     style="width:{{ 80 *($product->reviews()->pluck('feedbacks.rate')->avg() /5) }}px ">
                                                </div>
                                            @endif
                                            <a href=""
                                               class="mini_text render_count">{{ $product->reviews->count() }}
                                                review</a>
                                        </div>
                                        <div class="price">
                                            @if ($product->discount)
                                                <span
                                                    class="current">{{number_format(floor($product->price - ($product->price * $product->discount) / 100), 0, '.', '.') }}
                                                    VND</span>
                                                <span class="normal mini_text">{{ number_format($product->price) }}
                                                    VND</span>
                                            @else
                                                <span class="current">{{ number_format($product->price) }} VND</span>
                                            @endif
                                        </div>
                                        <div class="stock mini_text"
                                             data-stock="{{ $product->sold + $product->stock }}">
                                            <div class="qty">
                                                <span>Đã bán<strong class="qty_sold">
                                                        {{ $product->sold }}</strong></span>
                                                <span>Còn lại<strong class="qty_available">
                                                        {{ $product->stock }}</strong></span>
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
                                        <div class="voucher flexitem">
                                            @if ($product->brand->vouchers->count() > 0)
                                                <h4>Voucher của sản phẩm:
                                                </h4>
                                                <div class="flexitem voucher-product">
                                                    @foreach ($product->brand->vouchers as $voucher)
                                                        <p style="margin-right: 6px">{{$voucher->value}}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <form action="{{ url('payment') }}" method="POST" id="form_cart">
                                            @csrf
                                            <input name="product_id" hidden value="{{ $product->id }}">
                                            <div class="colors">
                                                <p>Color</p>
                                                <div class="variant">
                                                    @foreach ($product->attributevalues as $color)
                                                        @if ($color->attribute_id == 2)
                                                            <p>
                                                                <input type="radio" name="color"
                                                                       id="{{ $color->value }}"
                                                                       value="{{ $color->id }}">
                                                                <label for="{{ $color->value }}" class="circle size_bf"
                                                                       style="top:0; left:0; --bg:{{ $color->value }} "></label>
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                    @error('color')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="sizes">
                                                <p>Size</p>
                                                <div class="variant">

                                                    @foreach ($product->attributevalues as $size)
                                                        @if ($size->attribute_id == 1)
                                                            <p>
                                                                <input type="radio" name="size"
                                                                       id="{{ $size->value }}" value="{{ $size->id }}">
                                                                <label for="{{ $size->value }}" class="circle size_bf"
                                                                       style="top:0; left:0;"><span>{{ $size->value }}</span></label>
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                    @error('size')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="qty_control flexitem">
                                                    <div class="minus circle">-</div>
                                                    <input type="number" id="stock" value="1" name="stock"
                                                           min="1" max="{{ $product->stock }}">
                                                    <div class="plus circle">+</div>
                                                </div>
                                                @if ($product->stock > 0)
                                                    <div class="button_cart">
                                                        <button class="primary_button" id="add_to_cart"
                                                                onclick="add({{$product->id}})">Giỏ hàng
                                                        </button>
                                                    </div>
                                                    <div class="button_cart" style="margin-right: 1em">
                                                        <button type="submit" class="secondary_button">Mua ngay</button>
                                                    </div>
                                                @else
                                                    <div class="button_cart">
                                                        <button class="primary_button" style="opacity: .5"
                                                                onclick="soldOut(this)">Giỏ hàng
                                                        </button>
                                                    </div>
                                                    <div class="button_cart" style="margin-right: 1em">
                                                        <button type="submit" class="secondary_button"
                                                                style="opacity: .5" onclick="soldOut(this)">Mua ngay
                                                        </button>
                                                    </div>
                                            @endif
                                        </form>
                                        <div class="wish_share">
                                            <ul class="flexitem second_links" id="wish_love">
                                                @include('user.design.page_offer.wishlist')
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
                                                                href="{{url('brand/'.$product->brand->slug)}}"><span>{{ $product->brand->name }}</span></a>
                                                        </li>
                                                        <li><span>Category:</span>
                                                            @foreach ($product->categories as $category)
                                                                <a href="{{url('category/'. $category->slug)}}">
                                                                    <span>{{ $category->name }},</span></a>
                                                            @endforeach
                                                        </li>
                                                        <li><span>Số lượng: </span><span>{{ $product->stock }}</span>
                                                        </li>
                                                        <li><span>Đã bán:</span><span>{{ $product->sold }}</span></li>
                                                        <li><span>Đánh giá:</span><span>{{ round($rate, 1) }} sao</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="has_child">
                                                <a href="#0" class="icon_small">Giới thiệu sản phẩm</a>
                                                <div class="content">
                                                    <p>{!! $product->desce !!}</p>
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
                                                        class="mini_text render_count">{{ $product->reviews->count() }}</span></a>
                                                <div class="content">
                                                    <div class="reviews">
                                                        <h4>Bình luận của mọi người</h4>
                                                        <div class="review_block">
                                                            <div class="review_block_head">
                                                                <div class="flexitem">
                                                                    <span class="rate_sum">{{ round($rate, 1) }}
                                                                        sao</span>
                                                                    <span class="render_count">Trên
                                                                        {{ $product->reviews->count() }} đánh
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

                                                                            @foreach ($product->reviews()->orderBy('created_at', 'desc')->limit(6)->get() as $review)
                                                                                <li class="item">
                                                                                    <div class="review_form">
                                                                                        <p class="person">Bình luận bởi
                                                                                            {{ $review->name }}
                                                                                        </p>
                                                                                        <p class="mini_text">Vào ngày
                                                                                            {{ date('d-m-Y'), strtotime($review->created_at) }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="review_rating rating">
                                                                                        <div class="stars"
                                                                                             style="width: {{ 80 * ($review->rate / 5) }}px">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="review_img object_cover">
                                                                                        @if (!(empty($review->image)))
                                                                                            <img
                                                                                                src="{{ asset('storage/review/'. $review->image) }}"
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
                                                                                        <div
                                                                                            style="display:flex; gap:1em;">
                                                                                            @if (Auth::user()->name === $review->name)
                                                                                                <a href="#review_form"
                                                                                                   class="primary_button"
                                                                                                   style="border: none;outline:none"
                                                                                                   id="btn_edit"
                                                                                                   onclick="sendEdit({{ $review->id }})">Sửa</a>
                                                                                            @endif
                                                                                            @if (Auth::user()->name === $review->name || Auth::user()->role_id == 2)
                                                                                                <button type="submit"
                                                                                                        class="secondary_button"
                                                                                                        id="btn_delete"
                                                                                                        style="border:none; outline:none"
                                                                                                        onclick="sendDelete({{ $review->id }})">
                                                                                                    Xóa
                                                                                                </button>
                                                                                            @endif
                                                                                        </div>
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
                                                                                      id="create_review"
                                                                                      action="{{ url('/review/store/' . $product->id) }}"
                                                                                      method="POST"
                                                                                      enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="rating">
                                                                                        <p>Bạn có thấy hài lòng?</p>
                                                                                        <div class="rate_this"
                                                                                             style="margin-bottom: 23px">
                                                                                            <input type="radio"
                                                                                                   name="rate"
                                                                                                   id="star5"
                                                                                                   value="5">
                                                                                            <label for="star5"><i
                                                                                                    class="ri-star-fill"></i></label>
                                                                                            <input type="radio"
                                                                                                   name="rate"
                                                                                                   id="star4"
                                                                                                   value="4">
                                                                                            <label for="star4"><i
                                                                                                    class="ri-star-fill"></i></label>
                                                                                            <input type="radio"
                                                                                                   name="rate"
                                                                                                   id="star3"
                                                                                                   value="3">
                                                                                            <label for="star3"><i
                                                                                                    class="ri-star-fill"></i></label>
                                                                                            <input type="radio"
                                                                                                   name="rate"
                                                                                                   id="star2"
                                                                                                   value="2">
                                                                                            <label for="star2"><i
                                                                                                    class="ri-star-fill"></i></label>
                                                                                            <input type="radio"
                                                                                                   name="rate"
                                                                                                   id="star1"
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
                                                                                        <textarea cols="30" rows="10"
                                                                                                  name="content"
                                                                                                  required></textarea>
                                                                                    </p>
                                                                                    <p>
                                                                                        <input type="text" hidden
                                                                                               name="name"
                                                                                               value="{{ Auth::user()->name }}">
                                                                                        <input type="text" hidden
                                                                                               name="email"
                                                                                               value="{{ Auth::user()->email }}">
                                                                                    </p>
                                                                                    <button id="button_review"
                                                                                            type="submit"
                                                                                            class="primary_button"
                                                                                            style="border:none; outline:none">
                                                                                        Bình
                                                                                        luận
                                                                                    </button>
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
                                @foreach (App\Models\admin\Product::where('sale', '=', 1)->where('id', '!=', $product->id)->inRandomOrder()->limit(6)->get() as $product)
                                    <div class="item page_other">
                                        <div class="media">
                                            <div class="thumbnail object_cover">
                                                <a href="{{ url('pageoffer/' . $product->slug) }}">
                                                    <img src="{{ $product->images->first()->path }}"
                                                         alt="{{ $product->name }}">
                                                </a>
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
                                                @if (80 *
                                                        ($product->reviews()->pluck('feedbacks.rate')->avg() /
                                                            5) ==
                                                        0)
                                                    <div class="stars" style="background-image:none;width:150px">Chưa có
                                                        đánh giá
                                                    </div>
                                                @else
                                                    <div class="stars"
                                                         style="width:{{ 80 *($product->reviews()->pluck('feedbacks.rate')->avg() /5) }}px ">
                                                    </div>
                                                    <div class="mini_text">{{ $product->reviews->count() }} đánh giá
                                                    </div>
                                                @endif
                                            </div>
                                            <h3 class="main_links"><a
                                                    href="{{ url('detail/' . $product->slug) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
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
                                            <div class="stock mini_text"
                                                 data-stock="{{ $product->sold + $product->stock }}">
                                                <div class="qty">
                                                    <span>Đã bán<strong class="qty_sold">
                                                            {{ $product->sold }}</strong></span>
                                                    <span>Còn lại<strong class="qty_available">
                                                            {{ $product->stock }}</strong></span>
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
                        <div class="column" style="margin-top: 15px;">
                            <div class="sectop flexitem" style="border-bottom: none;">
                                <h2><span class="circle"></span><span>
                                      <i class="ri-price-tag-3-line"></i>  Tag sản phẩm
                                    </span></h2>
                            </div>
                            <div class="tags">
                                <ul class="flexitem" style="gap: 10px">
                                    <p style="margin-right: 10px"><i class="ri-price-tag-3-line"></i> Tags:</p>
                                    @if(!(empty($product->tags)))
                                        @php
                                            $tags = [];
                                            $tags = explode(',', $product->tags);
                                        @endphp
                                        @foreach($tags as $key=>$tag)
                                            <li>
                                                <a class="tag-link" href="{{url('tag/'.$tag)}}"
                                                   class="me-2">{{$tag}}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('javascript')
    @include('user.design.page_offer.script')

@endsection
