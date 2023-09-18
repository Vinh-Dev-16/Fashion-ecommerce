@if ($wishlists->count() > 0 )
    <h1 class="search_page">Danh sách phim yêu thích của bạn</h1>
    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="products main flexwrap">
                        @foreach ($wishlists as $result)
                            <div class="item page_other">
                                <button class="remove_wishlist" onclick="remove_wishlist({{$result->id}})">
                                    <i class="ri-close-line"></i>
                                </button>
                                <div class="media" style="position: relative">

                                    <div class="thumbnail object_cover">
                                        @if ($result->product->sale == 0)
                                            <a href="{{ url('detail/' . $result->product->slug) }}">
                                                <img src="{{ $result->product->images->first()->path }}" alt="{{ $result->product->name }}">
                                            </a>
                                        @else
                                            <a href="{{ url('pageoffer/' . $result->product->slug) }}">
                                                <img src="{{ $result->product->images->first()->path }}" alt="{{ $result->product->name }}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href="" style="background: #ff6b6b;opacity:1;"><i class="ri-heart-line"></i></a></li>
                                            @if ($result->product->sale == 0)
                                                <li><a href="{{url('detail/' . $result->product->slug)}}"><i class="ri-eye-line"></i></a></li>
                                            @else
                                                <li><a href="{{url('pageoffer/' . $result->product->slug)}}"><i class="ri-eye-line"></i></a></li>
                                            @endif
                                            <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                        </ul>
                                    </div>
                                    @if ($result->product->discount)
                                        <div class="discount circle flexcenter"><span>{{ $result->product->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="content">
                                    <div class="rating">
                                        @if (80 * ($result->product->reviews()->pluck('feedbacks.rate')->avg() / 5) == 0)
                                            <div class="stars" style="background-image:none;width:150px">Chưa có đánh giá</div>
                                        @else
                                            <div class="stars" style="width:{{ 80 * ($result->product->reviews()->pluck('feedbacks.rate')->avg() / 5) }}px "></div>
                                        @endif
                                        <div class="mini_text">({{$result->product->reviews->count()}}) </div>
                                    </div>
                                    @if ($result->product->sale == 0)
                                        <h3 class="main_links"><a
                                                href="{{ url('detail/' . $result->product->slug) }}">{{ Illuminate\Support\Str::of($result->product->name)->words(9) }}</a>
                                        </h3>
                                    @else
                                        <h3 class="main_links"><a
                                                href="{{ url('pageoffer/' . $result->product->slug) }}">{{ Illuminate\Support\Str::of($result->product->name)->words(9) }}</a>
                                        </h3>
                                    @endif
                                    <div class="price">
                                        @if ($result->product->discount)
                                            <span
                                                class="current">{{ number_format(floor($result->product->price - ($result->product->price * $result->product->discount) / 100)) }}
                                                VND</span>
                                            <span class="normal mini_text">{{ number_format($result->product->price) }} VND</span>
                                        @else
                                            <span class="current">{{ number_format($result->product->price) }} VND</span>
                                        @endif
                                    </div>
                                    <div class="footer">
                                        <ul class="mini_text">
                                            @foreach ($result->product->materials as $material)
                                                <li>{{$material->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $wishlists->links('vendor.pagination.default')}}
@else
    <h1 class="search_page">Bạn chưa có sản phẩm yêu thích nào</h1>
@endif
