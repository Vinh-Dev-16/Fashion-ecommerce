@extends('admin.layout')
@section('title')
    Trang Product
@endsection
@section('content')
    @if (Session::has('thongbao'))
        <div class='noti success_noti' style="top: 43px;right:8px">
            <h2> Thông báo thành công </h2>
            <p> Đã thêm product </p>
        </div>
    @endif
    @if (Session::has('sua'))
        <div class='noti success_noti' style="top: 43px;right:8px">
            <h2> Thông báo thành công </h2>
            <p> Đã sửa product </p>
        </div>
    @endif
    @if (Session::has('xoa'))
        <div class='noti success_noti' style="top: 43px;right:8px">
            <h2> Thông báo thành công </h2>
            <p> Đã xóa product </p>
        </div>
    @endif
    {{-- Thống kê --}}

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="fa-regular fa-percent"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $count }}</h3>

                <p>Số sản phẩm</p>
            </div>
            <div class="icon">
                <i class="fa-brands fa-product-hunt"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Content --}}
    <div class="col-md-12">
        <div class="card product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN PRODUCT</h2>
                    <h3 class="card-title"><a href="{{ route('admin.product.create') }}">Tạo mới product</a></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" id="search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Giảm giá</th>
                                <th>Tồn kho</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="infor_product">
                            <tr>
                                @foreach ($products as $product)
                                    <td>{{ $product->id }}</td>
                                    <td>{{ Illuminate\Support\Str::of($product->name)->words(4) }}</td>
                                    <td>{{ number_format($product->price) }} VND</td>
                                    <td>{{ $product->discount }}%</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">

                                        <a href="{{ url('admin/product/edit' , ['id'=>$product->id,'slug'=> Str::slug($product->slug)]) }}" title="Sửa Product"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color: #f4f4f4; font-size:22px;"></i></a>
                                        <form method="post" action="{{ url('admin/product/destroy/' . $product->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa Product"
                                                onclick=" return confirm ('Bạn có muốn xóa không?')"
                                                style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                    class="fa-solid fa-trash"
                                                    style="color: #f4f4f; font-size:22px;"></i></button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="search_result"></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{ $products->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
@endsection

@section('javascript')
    {{-- CDN Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- CDN jquery --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>


    {{-- Search input product --}}
    <script>
        $(document).ready(function() {
            $("#search").keyup(function() {
                $input = $(this).val();
                if ($input) {
                    $('.infor_product').hide();
                    $('#search_result').show();
                } else {
                    $('.infor_product').show();
                    $('#search_result').hide();
                }
                $.ajax({
                    url: "{{ URL::to('admin/product/search') }}",
                    method: "GET",
                    data: {
                        'search': $input
                    },
                    success: function(data) {
                        $("#search_result").html(data);
                    }
                });
            })
        })
    </script>
@endsection
