@extends('user.layout')
@section('title')
    Chi tiết sản phẩm {{ Illuminate\Support\Str::of($product->name)->words(4) }}
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
                                        <div class="swiper-button-next-small"></div>
                                        <div class="swiper-button-prev-small"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <h1>{{ $product->name }}</h1>
                                    <div class="content">
                                        <div class="rating" id="show_rating">

                                        </div>
                                    </div>
                                    <div class="stock_sku">
                                        <span class="avaiable">Số lượng</span>
                                        <span class="sku mini_text">160</span>
                                    </div>
                                    <div class="price">
                                        @if (!empty($product->discount))
                                            <span
                                                class="current">{{ number_format(floor($product->price - ($product->price * $product->discount) / 100)) }}
                                                VND</span>
                                            <span class="normal mini_text">{{ number_format($product->price) }}
                                                VND</span>
                                        @else
                                            <span class="current">{{ number_format($product->price) }} VND</span>
                                        @endif
                                    </div>

                                    <div class="voucher">
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
                                        <div class="color">
                                            <p>Color</p>
                                            <div class="variant">
                                                @foreach ($product->attributevalues as $color)
                                                    @if ($color->attribute_id == 2)
                                                        <p>
                                                            <input type="radio" name="color" id="{{ $color->value }}"
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
                                        @error('color')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="sizes">
                                            <p>Size</p>
                                            <div class="variant">
                                                @foreach ($product->attributevalues as $size)
                                                    @if ($size->attribute_id == 1)
                                                        <P>
                                                            <input type="radio" name="size" id="{{ $size->value }}"
                                                                   value="{{ $size->id }}">
                                                            <label for="{{ $size->value }}" class="circle size_bf"
                                                                   style="top:0; left:0;"><span>{{ $size->value }}</span></label>
                                                        </P>
                                                    @endif
                                                @endforeach
                                                @error('size')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @error('size')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="actions">
                                            <div class="qty_control flexitem">
                                                <div class="minus circle">-</div>
                                                <input type="number" id="stock" value="1" name="stock"
                                                       min="1" max="{{ $product->stock }}" required>
                                                <div class="plus circle">+</div>
                                            </div>
                                            @if ($product->stock > 0)
                                                <div class="button_cart">
                                                    <button class="primary_button" id="add_to_cart"
                                                            onclick="add_cart({{ $product->id }})">Giỏ hàng
                                                    </button>
                                                </div>
                                                <div class="button_cart" style="margin-right: 1em">
                                                    <button type="submit" class="secondary_button">Mua ngay</button>
                                                </div>
                                            @else
                                                <div class="button_cart">
                                                    <button class="primary_button" id="addtocart" style="opacity: .5"
                                                            onclick="soldOut(this)">Giỏ hàng
                                                    </button>
                                                </div>
                                                <div class="button_cart" style="margin-right: 1em">
                                                    <button type="submit" class="secondary_button" style="opacity: .5"
                                                            onclick="soldOut(this)">Mua ngay
                                                    </button>
                                                </div>
                                        @endif
                                    </form>
                                </div>

                                <div class="wish_share">

                                    <ul class="flexitem second_links" id="wish_love">
                                        @include('user.design.detail.wishlist')
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
                                                        href="{{ url('brand/' . $product->brand_id) }}"><span>{{ $product->brand->name }}</span></a>
                                                </li>
                                                <li><span>Category:</span>
                                                    @foreach ($product->categories as $category)
                                                        <a href="{{ url('category/' . $category->slug) }}">
                                                            <span>{{ $category->name }},</span></a>
                                                    @endforeach
                                                </li>
                                                <li><span>Số lượng: </span><span>{{ $product->stock }}</span>
                                                </li>
                                                <li><span>Đã bán:</span><span>{{ $product->sold }} sản phẩm </span>
                                                </li>
                                                <li><span>Đánh giá:</span><span class="rate_count_start">{{ round($rate, 1) }} sao</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="has_child">
                                        <a href="#" class="icon_small">Giới thiệu sản phẩm</a>
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
                                                class="mini_text count_feedback">{{ $product->feedbacks->count() }}</span></a>
                                        <div class="content">
                                            <div class="reviews">
                                                <h4>Đánh giá của mọi người</h4>
                                                <div class="review_block">
                                                    <div class="review_block_head">
                                                        <div class="flexitem">
                                                            <span class="rate_sum">{{ round($rate, 1) }}
                                                                sao</span>
                                                            <span class="render_count">Trên
                                                                {{ $product->feedbacks->count() }} đánh
                                                                giá</span>
                                                        </div>
                                                            <div class="review_block_body">
                                                                <ul id="review_ul">
                                                                    @include('user.design.detail.feedback')
                                                                </ul>
                                                                <div class="second_links">
                                                                    <a href="#" class="view_all">
                                                                        Xem thêm đánh giá
                                                                        <i class="ri-arrow-right-line"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
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
            {{-- Product --}}

            <div class="related_products">
                <div class="container">
                    <div class="wrapper">
                        <div class="column">
                            <div class="sectop flexitem">
                                <h2><span class="circle"></span><span>Sản phẩm liên quan</span></h2>
                                <div class="second_links"><a href="" class="view_all">Xem tất cả<i
                                            class="ri-arrow-right-line"></i></a></div>
                            </div>
                            <div class="products main flexwrap">
                                @foreach (App\Models\admin\Product::where('sale', '=', NOT_SALE)->where('brand_id', $product->brand_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(6)->get() as $product)
                                    <div class="item page_other">
                                        <div class="media">
                                            <div class="thumbnail object_cover">
                                                <a href="{{ url('detail/' . $product->slug) }}">
                                                    <img src="{{ $product->images->first()->path }}"
                                                         alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="hoverable">
                                                <ul>
                                                    <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                                    <li><a href="{{ url('pageoffer/' . $product->slug) }}"><i
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
                                            <div class="rating">
                                                @if (WIDTH_STAR *
                                                        ($product->feedbacks()->pluck('feedbacks.rate')->avg() /
                                                            MAX_RATE) ==
                                                        NOT_RATE)
                                                    <div class="stars" style="background-image:none;width:150px">Chưa có
                                                        đánh
                                                        giá
                                                    </div>
                                                @else
                                                    <div class="stars"
                                                         style="width:{{ 80 *($product->feedbacks()->pluck('feedbacks.rate')->avg() /5) }}px ">
                                                    </div>
                                                    <div class="mini_text">{{ $product->feedbacks->count() }} đánh giá
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
                                            <div class="footer">
                                                <ul class="mini_text">
                                                    @foreach ($product->materials as $material)
                                                        <li>{{$material->name}}</li>
                                                    @endforeach
                                                </ul>
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
    </div>
@endsection

@section('javascript')
    @include('user.design.detail.script')
@endsection
