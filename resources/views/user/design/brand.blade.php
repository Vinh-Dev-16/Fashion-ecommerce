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
                                       @foreach ($categories as $category )
                                       @if (!($category->parent_id == 0))
                                       <li>
                                        <input type="checkbox" name = "checkbox" id="{{$category->name}}">
                                        <label for="{{$category->name}}">
                                        <span class="checked"></span>
                                        <span>{{$category->name}}</span>
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
                                                <input type="radio" name="color" id="{{$color->value}}">
                                                <label for="{{$color->value}}" class="circle" style="background-color:{{$color->value}};margin-right:0.3em;"></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="filter_block pricing">
                                    <h4> Giá </h4>
                                        <div class="byprice">
                                            <div class="range_track">
                                                <input type="range" value="2500000" min="0" max="100000000">
                                            </div>
                                            <div class="price_range">
                                                <span class="price_form">50</span>
                                                <span class="price_to">500</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="row">
                                <div class="cat_head">
                                    <div class="breadcrumb">
                                        <ul class="flexitem">
                                            <li><a href="{{url('/')}}">Home</a></li>
                                            <li>{{$brand->name}}</li>
                                        </ul>
                                    </div>
                                    <div class="page_title">
                                        <h1>{{$brand->name}}</h1>
                                    </div>
                                    <div class="cat-description">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat at maxime nemo, id consequatur quibusdam dolorum ex blanditiis eum ducimus? Voluptas maxime, iste explicabo laboriosam obcaecati fugit eaque animi itaque!Accusamus ex illum optio velit veritatis quos assumenda eum? Aspernatur sed unde sit, accusantium aperiam error quidem nesciunt consectetur minima, quibusdam deleniti eligendi iusto reprehenderit molestiae veritatis voluptates illo hic!</p>
                                    </div>
                                    <div class="cat_navigation flexitem">
                                        <div class="item-filter desktop_hide">
                                            <a href="" class="filter_trigger lable">
                                                <i class="ri-menu-2-line ri-2x"></i>
                                                <span>Lọc</span>
                                            </a>
                                        </div>
                                        <div class="item_sortir">
                                            <div class="lable">
                                             <span class="mobile_hide">
                                                Sắp xếp theo
                                             </span>
                                             <div class="desktop_hide">Mặc định</div>
                                             <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                            <ul>
                                                <li>Default</li>
                                                <li>Product Name</li>
                                                <li>Price</li>
                                            </ul>
                                        </div>
                                        <div class="item-prepage mobile_hide">
                                            <div class="lable"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products main flexwrap"></div>
                            <div class="load_more flexcenter"><a href="" class="secondary_button">Xem thêm</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
