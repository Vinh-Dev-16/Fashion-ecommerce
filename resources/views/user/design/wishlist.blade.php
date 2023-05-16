@extends('user.layout')
@section('title')
    Danh sách yêu thích của bạn
@endsection
@section('content')
    @if (Auth::check())
    @if ($wishlists->count() > 0 ) 
    <h1 class="search_page">Danh sách phim yêu thích của bạn</h1>
    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="products main flexwrap">
                        @foreach ($wishlists as $result)
                            <div class="item page_other">
                                <form action="{{url('wishlist/delete/' .$result->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove_wishlist">
                                        <i class="ri-close-line"></i>
                                    </button>
                                </form>
                                <div class="media" style="position: relative">
                                   
                                    <div class="thumbnail object_cover">
                                        @if ($result->product->sale == 0)
                                        <a href="{{ url('detail/' . $result->product->id) }}">
                                            <img src="{{ $result->product->images->first()->path }}" alt="{{ $result->product->name }}">
                                        </a>
                                        @else
                                        <a href="{{ url('pageoffer/' . $result->product->id) }}">
                                            <img src="{{ $result->product->images->first()->path }}" alt="{{ $result->product->name }}">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href="" style="background: #ff6b6b;opacity:1;"><i class="ri-heart-line"></i></a></li>
                                            @if ($result->product->sale == 0)
                                            <li><a href="{{url('detail/' . $result->product->id)}}"><i class="ri-eye-line"></i></a></li>
                                            @else
                                            <li><a href="{{url('pageoffer/' . $result->product->id)}}"><i class="ri-eye-line"></i></a></li>
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
                                            href="{{ url('detail/' . $result->product->id) }}">{{ Illuminate\Support\Str::of($result->product->name)->words(9) }}</a>
                                    </h3>
                                    @else
                                    <h3 class="main_links"><a
                                        href="{{ url('pageoffer/' . $result->product->id) }}">{{ Illuminate\Support\Str::of($result->product->name)->words(9) }}</a>
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
    <h1 class="search_page">Bạn chưa có phim yêu thích nào</h1>
    @endif   
    @endif

    {{ $wishlists->links('vendor.pagination.default')}}
@endsection


@section('javascript')
    
    <script>
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');
       
       for(let i of dpt_menu){
        i.classList.add('active');
       }
       close_menu.forEach((item)=>{
         item.addEventListener('click', (e) => {
            e.preventDefault();
            for(let i of dpt_menu){
                i.classList.toggle('active');
            }
       });
    })    

    </script>

@endsection