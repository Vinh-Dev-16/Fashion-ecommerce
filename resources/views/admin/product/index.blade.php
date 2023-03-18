@extends('admin.layout')
@section('title')
    Trang Product
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN PRODUCT</h2>
                    <h3 class="card-title">
                        <a href="{{ route('admin.product.create') }}">Tạo mới product</a>
                        <span style="margin-left: 20px"><a href="{{route('admin.product.viewrestore')}}">Restore product</a></span>
                    </h3>
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
                                    @if ($product->discount)
                                    <td>{{ $product->discount }}%</td>
                                    @else
                                    <td>0%</td>   
                                    @endif
                                    <td>{{ $product->stock }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">

                                        <a href="{{ url('admin/product/edit/' . $product->id) }}" title="Sửa Product"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color: black; font-size:22px;"></i></a>
                                        <form method="post" action="{{ url('admin/product/destroy/' . $product->id) }}">
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
        <div class="item"></div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
@endsection

@section('javascript')
    {{-- Search input product --}}
    <script>
        
        function searchProduct() {
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
        }
        searchProduct();
    </script>
@endsection
