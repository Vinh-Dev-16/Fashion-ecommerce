@extends('admin.layout')
@section('title')
    Trang Brand
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12" style="display:flex;align-items: center;justify-content:center">
        <div class="product col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN BRAND</h2>
                    <h3 class="card-title"><a href="{{ route('admin.brand.create') }}">Tạo mới brand</a></h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" id="search" class="form-control float-right" placeholder="Search">

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
                                <th>Tên brand</th>
                                <th>Logo brand</th>
                                <th>Số sản phẩm</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="infor_brand">
                            <tr>
                                @foreach ($brands as $brand)
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td style="width:150px;height:120px;"><img class="logo_brand" src=" {{ $brand->logo }}"
                                            alt="Logo của {{ $brand->name }}"></td>
                                    @if ($brand->products->count() > 0)
                                        <td>{{ $brand->products->count() }}</td>
                                    @else
                                        <td>Chưa có sản phẩm</td>
                                    @endif
                                    <td class="table_crud" style="display:flex;justify-content:flex-start;">
                                        <a href="{{ url('admin/brand/edit/' . $brand->id) }}" title="Sửa Brand"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color:black; font-size:25px;"></i></a>
                                        <form method="post" action="{{ url('admin/brand/destroy/' . $brand->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa Brand"
                                                onclick=" return confirm ('Bạn có muốn xóa không?')"
                                                style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                    class="fa-solid fa-trash"
                                                    style="color: black; font-size:25px;"></i></button>
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
    </div>
    <div class="col-md-12" style="display: flex;justify-content: center;
      align-items: center;">
        {{ $brands->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Brand</li>
    </ol>
@endsection

@section('javascript')
    <script>
        function searchBrand() {
            $(document).ready(function() {
                $("#search").keyup(function() {
                    console.log(1);
                    $input = $(this).val();
                    if ($input) {
                        $('.infor_brand').hide();
                        $('#search_result').show();
                    } else {
                        $('.infor_brand').show();
                        $('#search_result').hide();
                    }
                    $.ajax({
                        url: "{{ URL::to('admin/brand/search') }}",
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
        searchBrand();
    </script>
@endsection
