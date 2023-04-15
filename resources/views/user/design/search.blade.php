@extends('user.layout')
@section('title')
    Tìm kiếm cho {{$key}}
@endsection
@section('content')
        @if ($searches->count() > 0)
        <h1 class="search_page">Kết quả tìm kiếm cho {{$key}}</h1>
        <div class="features">
            <div class="container">
                <div class="wrapper">
                    <div class="column">
                        <div class="sectop flexitem">
                            <h2><span class="circle"></span><span>Kết quả</span></h2>
                        </div>
                        <div class="products main flexwrap">
                            @foreach ($searches as $product)
                                <div class="item">
                                    <div class="media">
                                        <div class="thumbnail object_cover">
                                            @if ($product->sale == 0)
                                            <a href="{{ url('detail/' . $product->id) }}">
                                                <img src="{{ $product->images->first()->path }}" alt="{{ $product->name }}">
                                            </a>
                                            @else
                                            <a href="{{ url('pageoffer/' . $product->id) }}">
                                                <img src="{{ $product->images->first()->path }}" alt="{{ $product->name }}">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="hoverable">
                                            <ul>
                                                <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                                @if ($product->sale == 0)
                                                <li><a href="{{url('detail/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
                                                @else
                                                <li><a href="{{url('pageoffer/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
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
                                            <div class="stars"></div>
                                            <div class="mini_text">(160)</div>
                                        </div>
                                        @if ($product->sale == 0)
                                        <h3 class="main_links"><a
                                                href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                                        </h3>
                                        @else
                                        <h3 class="main_links"><a
                                            href="{{ url('pageoffer/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                                    </h3>
                                        @endif
                                        <div class="price">
                                            @if ($product->discount)
                                                <span
                                                    class="current">{{ number_format(floor($product->price - ($product->price * $product->discount) / 100)) }}
                                                    VND</span>
                                                <span class="normal mini_text">{{ number_format($product->price) }} VND</span>
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
                    </div>
                </div>
            </div>
        </div>
        @else
            <h1 class="search_page">Không có kết quả tìm kiếm cho {{$key}}</h1>
        @endif

        {{$searches->links('vendor.pagination.default')}}
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

    </script>

@endsection