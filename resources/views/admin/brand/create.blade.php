@extends('admin.layout')
@section('title')
    Trang tạo mới Brand
@endsection
@section('content')
 
    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TẠO MỚI BRAND</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tạo mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.brand.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên brand</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    placeholder="Điền tên brand" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Logo brand</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    placeholder="Link logo brand" name="logo">
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleDesce">Chi tiết Brand</label>
                                <textarea type="text" class="form-control" id="editor" name="description"
                                    placeholder="Điền thông tin sản phẩm"></textarea>
                                @error('description')
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
        <li class="breadcrumb-item "><a href="{{ route('admin.brand.index') }}">brand</a></li>
        <li class="breadcrumb-item active">Create Brand</li>
    </ol>
@endsection

@section('javascript')

    <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
