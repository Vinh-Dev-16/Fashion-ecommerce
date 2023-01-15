@extends('admin.layout')
@section('content')
    @if (Session::has('loi'))
        <div class='noti ' style="top: 43px;right:8px">
            <h2> Thông báo lỗi </h2>
            <p> Đã lỗi về thứ gì đó </p>
        </div>
    @endif

    <div class="col-md-12">
        <div class="card product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA CATEGORY</h2>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/category/update/' . $category->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên loại sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{ $category->name }}" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.category.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit Products</li>
    </ol>
@endsection
