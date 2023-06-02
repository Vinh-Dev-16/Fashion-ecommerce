@extends('user.layout')
@section('title')
    Brand {{ $brand->name }}
@endsection
@section('content')
    <div class="single_category">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="holder">
                        <div class="row sidebar">
                            <div class="filter">
                                <div class="filter_block ">
                                    <h4>Category</h4>
                                    <ul>
                                        @foreach ($categories as $category)
                                            @if (!($category->parent_id == 0))
                                                <li>
                                                    <input type="radio" name="categories[]" id="{{ $category->name }}" value="{{ $category->id}}">
                                                    <label for="{{ $category->name }}">
                                                        <span class="checked"></span>
                                                        <span>{{ $category->name }}</span>
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="filter_block products">
                                    <h4>Color</h4>
                                    <ul class="bycolor variant flexitem">
                                        @foreach (App\Models\admin\ValueAttribute::where('attribute_id', '=', '2')->get() as $color)
                                            <li>
                                                <input type="radio" name="color" id="{{ $color->value }}">
                                                <label for="{{ $color->value }}" class="circle" style="background-color:{{ $color->value }};margin-right:0.3em;"></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="row">
                                <div class="cat_head">
                                    <div class="breadcrumb">
                                        <ul class="flexitem">
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li>{{ $brand->name }}</li>
                                        </ul>
                                    </div>
                                    <div class="page_title">
                                        <h1>{{ $brand->name }}</h1>
                                    </div>
                                    <div class="cat_description">
                                        <p>{!! $brand->description !!}</p>
                                    </div>
                                    <div class="cat_navigation flexitem">
                                        <div class="item_filter desktop_hide">
                                            <a href="" class="filter_trigger lable">
                                                <i class="ri-menu-2-line"></i>
                                                <span>Lọc</span>
                                            </a>
                                        </div>
                                        <div class="item_sortir">
                                            <div class="lable">
                                                <span class="mobile_hide">
                                                    Sắp xếp theo
                                                </span>
                                                <div class="desktop_hide">Sắp xếp theo</div>
                                                <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                            <ul>
                                                <li onclick="defaultFilter(this,{{$brand->id}})" value="1">Default</li>
                                                <li onclick="productName(this,{{$brand->id}})" value="2">Tên sản phẩm</li>
                                                <li onclick="price(this,{{$brand->id}})" value="3">Price</li>
                                            </ul>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="products main flexwrap" id="show_filter">
                                @foreach ($paginate as $product)
                                <div class="item">
                                    <div class="media">
                                        <div class="thumbnail object_cover">
                                            @if ($product->sale == 0)
                                                <a href="{{ url('detail/' . $product->id) }}">
                                                    <img src="{{ $product->images->first()->path }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            @else
                                                <a href="{{ url('pageoffer/' . $product->id) }}">
                                                    <img src="{{ $product->images->first()->path }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="hoverable">
                                            <ul>
                                                <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                                                @if ($product->sale == 0)
                                                    <li><a href="{{ url('detail/' . $product->id) }}"><i
                                                                class="ri-eye-line"></i></a></li>
                                                @else
                                                    <li><a href="{{ url('pageoffer/' . $product->id) }}"><i
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
                                                    href="{{ url('detail/' . $product->id) }}">{{Illuminate\Support\Str::of($product->name)->words(9)}}
                                                </a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{$paginate->links(('vendor.pagination.default'))}}
@endsection

@section('javascript')
    <script>
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');
        const form = document.querySelectorAll("input[name='categories[]']");
        const checkedValues = [];
        form.forEach((checkbox)=>{
            checkbox.addEventListener('click',(e)=>{
                if(e.target.checked){
                    checkedValues.push(e.target.value);
                }else{
                    const index = checkedValues.indexOf(event.target.value);
                    if (index !== -1) {
                        checkedValues.splice(index, 1);
                    }
                }
            })
        });
        console.log(checkedValues);
        

        const FtoShow = '.filter';
        const Fpopup = document.querySelector(FtoShow);
        const Ftrigger = document.querySelector('.filter_trigger');
        Ftrigger.addEventListener('click',(e)=>{
            e.preventDefault();
            setTimeout(() => {
               if(!Fpopup.classList.contains('show')){
                Fpopup.classList.add('show');
               } 
            }, 250);
        })
        document.addEventListener('click', (e)=>{
            const isClosest = e.target.closest(FtoShow);
            if(!isClosest && Fpopup.classList.contains('show')){
                Fpopup.classList.remove('show');
            }
        })

        // filtering

        function price(elemnet,id){
            filtering(id, elemnet.value);
        }

        function defaultFilter(elemnet,id){
            filtering(id, elemnet.value);
        }
        function productName(elemnet,id){
            filtering(id, elemnet.value);
        }
       async function filtering(id, value){
            const res = await fetch(`http://127.0.0.1:8000/filtering/${id}/${value}`)
                .then((response) => response.json())
                .then((data) => {
                    showFilter(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }

        function showFilter(data) {
            let filter = '';
            console.log(data);
            data.result.map((item) => {
                if (item.discount) {
                    var price = (item.price - (item.price * ((item.discount) / 100)));
                } else {
                    var price = item.price;
                };
                filter+= `
                      <div class="item">
                                    <div class="media">
                                        <div class="thumbnail object_cover">
                                            ${
                                                (()=>{
                                                    if (item.sale == 0){
                                                        return `
                                                        <a href="{{ url('detail/${item.id}') }}">
                                                            <img src="${item.images[0].path}"
                                                                alt="${item.name}">
                                                        </a>
                                                        `
                                                    }
                                                    else{
                                                        return `
                                                        <a href="{{ url('pageoffer/${item.id}') }}">
                                                            <img src="${item.images[0].path}"
                                                                alt="${item.name}">
                                                        </a>
                                                        `
                                                    }
                                                })()
                                        }
                                        </div>
                                        <div class="hoverable">
                                            <ul>
                                                <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>

                                                ${
                                                    (()=>{
                                                        if(item.sale == 0){
                                                        return `
                                                             <li><a href="{{ url('detail/${item.id}') }}"><i
                                                                class="ri-eye-line"></i></a></li>
                                                                `
                                                        }else{
                                                            return `
                                                            <li><a href="{{ url('pageoffer/${item.id}') }}"><i
                                                                class="ri-eye-line"></i></a></li>
                                                            `
                                                        }
                                                    })()
                                                }
                                                <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                                            </ul>
                                        </div>

                                                 ${
                                                    (()=>{
                                                        if(item.discount >0){
                                                        return `
                                                        <div class="discount circle flexcenter">
                                                            <span>${item.discount}%</span>
                                                        </div>
                                                                `
                                                        }else{
                                                            return `
                                                            `
                                                        }
                                                    })()
                                                }
                                    </div>
                                    <div class="content">
                                              <div class="rating">
                                                ${
                                                    (()=>{
                                                        if(item.rate == 0){
                                                        return `
                                                        <div class="stars" style="background-image:none;width:150px">Chưa có đánh giá</div>
                                                                `
                                                        }else{
                                                            return `
                                                            <div class="stars" style="width:80 *(${item.rate} /5)px ">
                                                             </div>
                                                            `
                                                        }
                                                    })()
                                                }
                                            <div class="mini_text">${item.count} review</div>
                                          </div>
                                              ${
                                                    (()=>{
                                                        if(item.sale == 0){
                                                        return `
                                                        <h3 class="main_links"><a href="{{ url('detail/${item.id}') }}">${(item.name).substring(0,30)}</a>
                                                     </h3>
                                                                `
                                                        }else{
                                                            return `
                                                            <h3 class="main_links"><a href="{{ url('pageoffer/${item.id}') }}">${(item.name).substring(0,30)}</a>
                                                            `
                                                        }
                                                    })()
                                                }
                                        <div class="price">
                                            ${
                                                    (()=>{
                                                        if(item.discount >0){
                                                        return `
                                                        <span  class="current">${price.toLocaleString('vi-VN')} VND</span>
                                                         <span class="normal mini_text">${(item.price).toLocaleString('vi-VN')} VND</span>
                                                          `
                                                        }else{
                                                            return `
                                                            <span class="current">${(item.price).toLocaleString('vi-VN')} VND</span>
                                                            `
                                                        }
                                                    })()
                                                }
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
                `
            });
            document.querySelector('#show_filter').innerHTML = filter;
        }

        for (let i of dpt_menu) {
            i.classList.add('active');
        }
        close_menu.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                for (let i of dpt_menu) {
                    i.classList.toggle('active');
                }
            });
        })
    </script>
@endsection
