@extends('user.layout')
@section('title')
  Fashion 
@endsection
@section('content')
    {{-- Slider --}}

    <div class="flex home_user" style="background-image: url({{ asset('images/bg1.jpg') }});  filter: brightness(0.9);">
        <div class="text_slider">
        </div>
        <div class="slider_animation">
            <img src="{{ asset('images/ani1.png') }}" alt="slider1" class="ani1">
            <div class="img_slider slider1" style="background-image: url('{{ asset('images/slider1.png') }}')"></div>
            <img src="{{ asset('images/ani2.png') }}" alt="slider2" class="ani2">
            <div class="img_slider slider2" style="background-image: url('{{ asset('images/slider2.png') }}')"></div>
            <img src="{{ asset('images/ani3.png') }}" alt="slider3" class="ani3">
            <div class="img_slider slider3" style="background-image: url('{{ asset('images/slider3.png') }}')"></div>
        </div>
    </div>
    {{-- Brand --}}

    <div class="brand_home">
        <h3> Brand Fashion </h3>
        <div class="brand">
            <div class="container">
                <div class="wrapper flexitem">
                    @foreach ($brands as $brand)
                        <div class="item">
                            <a href="{{ url('brand/' . $brand->id) }}">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Trending Product --}}

    <div class="trending">
        <div class="container">
            <div class="wrapper">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Trending Products</span></h2>
                </div>
                <div class="column">
                    <div class="flexwrap">
                        @foreach ($products->take(1) as $product)
                            <div class="row products big">
                                <div class="item">
                                    <div class="offer">
                                        <p>Offer hết hạn vào </p>
                                        <ul class="flexcenter">
                                            <li class="days"></li>
                                            <li class="hours"></li>
                                            <li class="minutes"></li>
                                            <li class="seconds"></li>
                                        </ul>
                                    </div>
                                    <div class="media">
                                        <div class="images">
                                            <a href="{{ url('pageoffer/' . $product->id) }}">
                                                <img src="{{ $product->images->first()->path }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="hoverable">
                                            <ul>
                                                <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                                <li><a href="{{url('detail/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
                                                <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="rating">
                                            <div class="stars"></div>
                                            <div class="mini_text">(160)</div>
                                        </div>
                                        <h3 class="main_links"><a
                                                href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                                        </h3>
                                        <div class="price">
                                            <span
                                                class="current">{{ number_format(floor($product->price - ($product->price * $product->discount) / 100)) }}
                                                VND</span>
                                            <span class="normal mini_text">{{ number_format($product->price) }} VND</span>
                                        </div>
                                        <div class="stock mini_text">
                                            <div class="qty">
                                                <span>Số lượng: <strong
                                                        class="qty_available">{{ $product->stock }}</strong></span>
                                                <span>Đã bán: <strong class="qty_sold">60</strong></span>
                                            </div>
                                            <div class="bar">
                                                <div class="available"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        @endforeach
                    </div>
                    <div class="row products mini">
                            @foreach (App\Models\admin\Product::where('id', '>', 1)->get()->take(3) as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail " style="object-fit: cover">
                                        <a href="{{ url('detail/' . $product->id) }}">
                                            <img src="{{ $product->images->first()->path }}" style="height: 100%">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                            <li><a href="{{url('detail/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
                                            <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                        </ul>
                                    </div>
                                    @if ($product->discount)
                                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="content">
                                    <h3 class="main_links"><a
                                            href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(4) }}</a>
                                    </h3>
                                    <div class="rating">
                                        <div class="stars"></div>
                                        <div class="mini_text">(160)</div>
                                    </div>
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
                                    <div class="mini_text">
                                        <p>Đã bán 30</p>
                                        <p>Free Shipping</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row products mini">
                            @foreach (App\Models\admin\Product::where('id', '>', 5)->get()->take(3) as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail " style="object-fit: cover">
                                        <a href="{{ url('detail/' . $product->id) }}">
                                            <img src="{{ $product->images->first()->path }}" style="height: 100%">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                            <li><a href="{{url('detail/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
                                            <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                        </ul>
                                    </div>
                                    @if ($product->discount)
                                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="content">
                                    <h3 class="main_links"><a
                                            href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(4) }}</a>
                                    </h3>
                                    <div class="rating">
                                        <div class="stars"></div>
                                        <div class="mini_text">(160)</div>
                                    </div>
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
                                    <div class="mini_text">
                                        <p>Đã bán 30</p>
                                        <p>Free Shipping</p>
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


    {{-- Product --}}

    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="sectop flexitem">
                        <h2><span class="circle"></span><span>View Products</span></h2>
                        <div class="second_links"><a href="" class="view_all">Xem tất cả<i
                                    class="ri-arrow-right-line"></i></a></div>
                    </div>
                    <div class="products main flexwrap">
                        @foreach (App\Models\admin\Product::where('id' , '>' , 1)->orderBy('created_at', 'desc')->get()->take(9) as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail object_cover">
                                        <a href="{{ url('detail/' . $product->id) }}">
                                            <img src="{{ $product->images->first()->path }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                            <li><a href="{{url('detail/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
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
                                    <h3 class="main_links"><a
                                            href="{{ url('detail/' . $product->id) }}">{{ Illuminate\Support\Str::of($product->name)->words(9) }}</a>
                                    </h3>
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection

@section('javascript')
    <script>
        //Phần deal of day
        let countDate = new Date('29,march,2023 00:00:00').getTime();

        function countDown() {
            let now = new Date().getTime();

            gap = countDate - now;

            let seconds = 1000;
            let minutes = seconds * 60;
            let hours = minutes * 60;
            let day = hours * 24;
            let d = Math.floor(gap / (day)) < 10 ? '0' + Math.floor(gap / (day)) : Math.floor(gap / day);
            let h = Math.floor((gap % (day)) / (hours)) < 10 ? '0' + Math.floor((gap % (day)) / (hours)) : Math.floor((gap %
                (day)) / (hours));
            let m = Math.floor((gap % (hours)) / (minutes)) < 10 ? '0' + Math.floor((gap % (hours)) / (minutes)) : Math
                .floor((gap % (hours)) / (minutes));
            let s = Math.floor((gap % (minutes)) / (seconds)) < 10 ? '0' + Math.floor((gap % (minutes)) / (seconds)) : Math
                .floor((gap % (minutes)) / (seconds));

            document.querySelector('.days').innerText = d;
            document.querySelector('.hours').innerText = h;
            document.querySelector('.minutes').innerText = m;
            document.querySelector('.seconds').innerText = s;


        }
        setInterval(() => {
            countDown()
        }, 1000);
    </script>
@endsection
