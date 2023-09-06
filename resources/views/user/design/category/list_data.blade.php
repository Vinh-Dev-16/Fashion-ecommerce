@if(count($products) > 0)

    <div class="products main flexwrap" id="show_filter">
        @foreach ($products as $product)
            <div class="item">
                <div class="media">
                    <div class="thumbnail object_cover">
                        @if ($product->sale == 0)
                            <a href="{{ url('detail/' . $product->slug) }}">
                                <img src="{{ $product->images->first()->path }}"
                                     alt="{{ $product->name }}">
                            </a>
                        @else
                            <a href="{{ url('pageoffer/' . $product->slug) }}">
                                <img src="{{ $product->images->first()->path }}"
                                     alt="{{ $product->name }}">
                            </a>
                        @endif
                    </div>
                    <div class="hoverable">
                        <ul>
                            @if (Auth::check())
                                @if (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->count() > 0)
                                    @foreach (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get() as $love)
                                        <li class="active ">
                                            <a href="javascript:void(0)" class="love" onclick="love({{$product->id}})">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="active">
                                        <a href="javascript:void(0)" onclick="love({{$product->id}})">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="active"><a href="javascript:void(0)" onclick="createToast('Bạn cần phải đăng nhập')"><i class="ri-heart-line"></i></a></li>
                            @endif
                            @if ($product->sale == 0)
                                <li><a href="{{ url('detail/' . $product->slug) }}"><i
                                            class="ri-eye-line"></i></a></li>
                            @else
                                <li><a href="{{ url('pageoffer/' . $product->slug) }}"><i
                                            class="ri-eye-line"></i></a></li>
                            @endif
                            <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                        </ul>
                    </div>
                    @if ($product->discount)
                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                        </div>
                    @endif
                </div>
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
                        <div class="mini_text">{{ $product->reviews->count() }} review</div>
                    </div>
                    @if ($product->sale == 0)
                        <h3 class="main_links"><a
                                href="{{ url('detail/' . $product->slug) }}">{{Illuminate\Support\Str::of($product->name)->words(9)}}
                            </a>
                        </h3>
                    @else
                        <h3 class="main_links"><a
                                href="{{ url('pageoffer/' . $product->slug) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                        </h3>
                    @endif
                    <div class="price">
                        @if ($product->discount)
                            <span
                                class="current">{{ number_format(floor($product->price - ($product->price * $product->discount) / 100)) }}
                                                        VND</span>
                            <span class="normal mini_text">{{ number_format($product->price) }}
                                                        VND</span>
                        @else
                            <span class="current">{{ number_format($product->price) }} VND</span>
                        @endif
                    </div>
                    <div class="footer">
                        <ul class="mini_text">
                            <li>Cotton, Polyester</li>
                            <li>100% nguyên chất</li>
                            <li>Phong cách</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$products->links('vendor.pagination.default')}}
@else
    <h2 style="text-align: center; color:  #ff6b6b">Không có kết quả</h2>

@endif
