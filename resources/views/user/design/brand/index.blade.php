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
                                                    <input type="checkbox" class="select-cateogry" name="categories[]" id="{{ $category->name }}"
                                                           value="{{ $category->id}}">
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
                                                <input type="radio" class="select-color" name="color" id="{{ $color->value }}">
                                                <label for="{{ $color->value }}" class="circle"
                                                       style="background-color:{{ $color->value }};margin-right:0.3em;"></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button class="btn btn-primary" id="cancel-filter"  >
                                    <i class="ri-close-line"></i>
                                    Hủy lọc
                                </button>
                            </div>
                        </div>
                        <input type="hidden" value="{{$brand->slug}}" id="slug">
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
                                                <select class="select-filter" id="select-filter">
                                                    <option selected disabled>
                                                        Sắp xếp
                                                    </option>
                                                    <option  value="0">
                                                        Mặc định
                                                    </option>
                                                    <option value="1">
                                                        Giá tăng dần
                                                    </option>
                                                    <option value="2">
                                                        Giá giảm dần
                                                    </option>
                                                    <option value="3">
                                                        A-Z
                                                    </option>
                                                    <option value="4">
                                                        Z-A
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="show-data">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @include('user.design.brand.script')
@endsection
