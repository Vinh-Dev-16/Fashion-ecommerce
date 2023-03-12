@extends('admin.layout')
@section('title')
    Trang Category
@endsection
@section('content')
    {{-- Content --}}
    <div class="col-md-12" style="display:flex;align-items: center;justify-content:center">
        <div class="product col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN CATEGORY</h2>
                    <h3 class="card-title"><a href="{{ route('admin.category.create') }}">Tạo mới category</a></h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" id="search" class="form-control float-right"
                                placeholder="Search tên">

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
                                <th>Tên loại sản phẩm</th>
                                <th>Bố của nó</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="infor_category">
                            <tr>
                                @foreach ($categories as $category)
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->parent_id == 0)
                                            <p>Không có</p>
                                        @elseif ($parent = \App\Models\admin\Category::find($category->parent_id))
                                            {{ $parent->name }}
                                        @endif
                                    </td>
                                    <td class="table_crud" style="display:flex;justify-content:flex-start;">

                                        <a href="{{ url('admin/category/edit/' . $category->id) }}" title="Sửa Category"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color: green; font-size:25px;"></i></a>
                                        <a href="{{ url('admin/category/destroy' . $category->id) }}" type="submit"
                                            title="Xóa Category" onclick=" return confirm ('Bạn có muốn xóa không?')"
                                            style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                class="fa-solid fa-trash" style="color: red; font-size:25px;"></i><a>
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
        {{ $categories->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
    </ol>
@endsection

@section('javascript')
    <script>
        function searchCategory() {
            $(document).ready(function() {
                $("#search").keyup(function() {
                    console.log(1);
                    $input = $(this).val();
                    if ($input) {
                        $('.infor_category').hide();
                        $('#search_result').show();
                    } else {
                        $('.infor_category').show();
                        $('#search_result').hide();
                    }
                    $.ajax({
                        url: "{{ URL::to('admin/category/search') }}",
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
        searchCategory();
    </script>
@endsection
