@extends('admin.layout')
@section('title')
    Trang sửa Brand
@endsection
@section('content')
  

    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA BRAND</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/brand/update/' . $brand->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên brand sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputName" value="{{ $brand->name }}"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Logo brand</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{$brand->logo}}" name="logo" >
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                                <label for="exampleName">Chi tiết Brand</label>
                                <textarea type="text" class="form-control" id="editor" name="description"
                                    placeholder="Điền thông tin sản phẩm"></textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.brand.index') }}">Brand</a></li>
        <li class="breadcrumb-item active">Edit Brand</li>
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
