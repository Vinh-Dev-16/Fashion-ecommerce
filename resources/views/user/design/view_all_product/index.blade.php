@extends('user.layout')
@section('title')
    Các sản phẩm
@endsection
@section('content')

    <h1 class="search_page" style="font-family: auto">Tất cả sản phẩm</h1>

    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="filter-view-all-product">
                    <div class="filter-title">
                        <h3>Bộ lọc</h3>
                    </div>
                    <div class="filter-content">
                        <div class="filter-content-item">
                            <div class="filter-content-item-title">
                                <h4>Giá</h4>
                            </div>
                            <div class="filter-content-item-content">
                                <div class="filter-content-item-content-price">
                                   <select id="select-price" class="js-states form-control">
                                       <option></option>
                                       <option value="1">Dưới 100.000đ</option>
                                       <option value="2">100.000đ - 500.000đ</option>
                                       <option value="3">500.000đ - 1.000.000đ</option>
                                       <option value="4">1.000.000đ - 5.000.000đ</option>
                                       <option value="5">Trên 5.000.000đ</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="filter-content-item-title">
                                <h4>Màu sắc</h4>
                            </div>
                            <div class="filter-content-item-content">
                                <div class="filter-content-item-content-price">
                                   <select id="select-color">
                                       <option></option>
                                       @foreach (App\Models\admin\ValueAttribute::where('attribute_id', '=', '2')->get() as $color)
                                           <option value="{{$color->id}}">{{$color->value}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="filter-content-item-title">
                                <h4>Size</h4>
                            </div>
                            <div class="filter-content-item-content">
                                <div class="filter-content-item-content-price">
                                   <select id="select-size">
                                       <option></option>
                                       @foreach (App\Models\admin\ValueAttribute::where('attribute_id', '=', '1')->get() as $size)
                                           <option value="{{$size->id}}">{{$size->value}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="filter-content-item-title">
                                <h4>Brand</h4>
                            </div>
                            <div class="filter-content-item-content">
                                <div class="filter-content-item-content-price">
                                   <select id="select-brand">
                                        <option></option>
                                        @foreach (App\Models\admin\Brand::all() as $brand)
                                             <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="filter-content-item-title">
                                <h4>Danh mục</h4>
                            </div>
                            <div class="filter-content-item-content">
                                <div class="filter-content-item-content-price">
                                   <select id="select-category">
                                      <option></option>
                                       @foreach(\App\Models\admin\Category::where('parent_id' , '!=', '0')->get() as $category)
                                           <option value="{{$category->id}}">{{$category->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="filter-content" style="justify-content: left; margin-left: 23px; margin-bottom: 50px">
                    <div class="filter-content-item">
                        <div class="filter-content-item-title">
                            <h4>Sắp xếp</h4>
                        </div>
                        <div class="filter-content-item-content">
                            <div class="filter-content-item-content-price">
                                <select id="select-sort">
                                    <option></option>
                                    <option value="1">Mới nhất</option>
                                    <option value="2">Giá tăng dần</option>
                                    <option value="3">Giá giảm dần</option>
                                    <option value="4">A-Z</option>
                                    <option value="5">Z-A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="column" id="show-data">
                    @include('user.design.view_all_product.list_data')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @include('user.design.view_all_product.script')
@endsection
