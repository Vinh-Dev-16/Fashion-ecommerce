@extends('user.layout')
@section('title')
  Fashion 
@endsection
@section('content')
    {{-- Slider --}}

    <div class="flex home_user  " style="background-image: url({{ asset('images/bg1.jpg') }});  filter: brightness(0.9);">
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
                        @foreach (App\Models\admin\Product::where('sale', '=', 1)->limit(1)->get() as $product)
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
                                                <li><a href="{{url('pageoffer/' . $product->id)}}"><i class="ri-eye-line"></i></a></li>
                                                <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                        </div>
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
                                                        class="qty_available">{{ $product->stock + $product->sold}}</strong></span>
                                                <span>Đã bán: <strong class="qty_sold">{{$product->sold}}</strong></span>
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
                            @foreach (App\Models\admin\Product::where('sale' , '=' ,1)->inRandomOrder()->limit(3)->get() as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail " style="object-fit: cover">
                                        <a href="{{ url('pageoffer/' . $product->id) }}">
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
                                        @if (80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) == 0)
                                        <div class="stars" style="background-image:none;width:150px">Chưa có đánh giá</div> 
                                        @else
                                        <div class="stars" style="width:{{ 80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) }}px "></div> 
                                        @endif
                                        <div class="mini_text">{{$product->reviews->count()}} review</div>
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
                                        <p>Đã bán {{$product->sold}}</p>
                                        <p>Free Shipping</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row products mini">
                            @foreach (App\Models\admin\Product::where('sale' , '=' ,1)->inRandomOrder()->limit(3)->get() as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail " style="object-fit: cover">
                                        <a href="{{ url('pageoffer/' . $product->id) }}">
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
                                        @if (80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) == 0)
                                        <div class="stars" style="background-image:none;width:150px">Chưa có đánh giá</div> 
                                        @else
                                        <div class="stars" style="width:{{ 80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) }}px "></div> 
                                        @endif
                                        <div class="mini_text">{{$product->reviews->count()}} review</div>
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
                                        <p>Đã bán {{$product->sold}}</p>
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
                        <div class="second_links"><a href="{{url('viewAllProducts')}}" class="view_all">Xem tất cả<i
                                    class="ri-arrow-right-line"></i></a></div>
                    </div>
                    <div class="products main flexwrap">
                        @foreach (App\Models\admin\Product::where('sale' , '=' , 0)->inRandomOrder()->limit(9)->get() as $product)
                            <div class="item page_other">
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
                                        @if (80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) == 0)
                                        <div class="stars" style="background-image:none;width:150px">Chưa có đánh giá</div> 
                                        @else
                                        <div class="stars" style="width:{{ 80 * ($product->reviews()->pluck('feedbacks.rate')->avg() / 5) }}px "></div> 
                                        @endif
                                        <div class="mini_text">{{$product->reviews->count()}} review</div>
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
 
@endsection

@section('modal')
    <div id="modal" class="modal">
        <div class="content flexcol">
            <div class="image object_cover">
                <img src="{{asset('images/apparel4.jpg')}}">
            </div>
            <h2>Chào mừng đến với Fashion</h2>
            <p class="mobile_hide">Web Fashion E-commerce
                <br>
                Nhanh tay nhanh tay! Nhận ngay deal hot
            </p>
            <form action="" class="search">
                <span class="icon-large"><i class="ri-mail-line"></i></span>
                <input type="email" name="email" placeholder="Email của bạn" style="width:85%;padding: 0 2em 0 4.5em;">
                <button>Đăng kí</button>
            </form>
            <a href="" class="mini_text again">Không show nó lần nữa</a>
            <a href="#" class="t_close modalclose flexcenter">
                <i class="ri-close-line"></i>
            </a>
        </div>
    </div>
    <div class="overlay"></div>
@endsection
@section('javascript')
    <script>
        if(window.sessionStorage.getItem('close')){
            window.onload = function(){
            document.querySelector('.site').classList.remove('showmodal')    
            }; 
        }else{
            window.onload  = function (){
            document.querySelector('.site').classList.toggle('showmodal')
        };
        }
        document.querySelector('.modalclose').addEventListener('click', function(){
            document.querySelector('.site').classList.remove('showmodal')
        });


        document.querySelector('.again').addEventListener('click', function(e){
            e.preventDefault();
            window.sessionStorage.setItem('close','showmodal');
            document.querySelector('.site').classList.remove('showmodal');
        });
        //Phần deal of day
        let countDate = new Date('29,Jun,2023 00:00:00').getTime();

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
