@if(count($products) > 0)
<div class="products main flexwrap" >
    @foreach ($products as $product)
        <div class="item page_other">
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
                    <ul id="hover-able">

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
                            đánh giá</div>
                    @else
                        <div class="stars"
                             style="width:{{ 80 *($product->reviews()->pluck('feedbacks.rate')->avg() /5) }}px ">
                        </div>
                    @endif
                    <div class="mini_text">{{ $product->reviews->count() }} review</div>
                </div>
                @if ($product->sale == 0)
                    <h3 class="main_links"><a
                            href="{{ url('detail/' . $product->slug) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
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
                       @foreach ($product->materials as $material)
                           <li>{{$material->name}}</li>
                       @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $products->render('vendor.pagination.default') }}
@else
    <h2 style="text-align: center; color:  #ff6b6b">Không có kết quả</h2>
@endif
