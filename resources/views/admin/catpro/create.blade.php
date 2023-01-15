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
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TẠO MỚI RELATIONSHIP</h2>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tạo mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.catpro.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên sản phẩm</label>
                                <select class="form-control" name="id_product">
                                    <option selected>Chọn tên sản phẩm</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    @error('id_category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                                @error('id_product')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Tên loại sản phẩm</label>
                                <select class="form-control" name="id_category">
                                    <option>Chọn tên loại sản phẩm</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    @error('id_category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
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
        <li class="breadcrumb-item "><a href="{{ route('admin.catpro.index') }}">Relationship</a></li>
        <li class="breadcrumb-item active">Create Relationship</li>
    </ol>
@endsection
