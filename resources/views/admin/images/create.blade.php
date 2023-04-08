@extends('admin.layout')
@section('title')
    Trang tạo mới Image Product
@endsection
@section('content')
 
    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TẠO MỚI IMAGES</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tạo mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.images.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Path ảnh</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    placeholder="Path ảnh" name="path">
                                @error('path')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Bố của nó</label>
                                   <select class="select2" name="product_id" style="width: 100%;height:100%">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                   </select>
                                @error('product_id')
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
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.images.index') }}">Images</a></li>
        <li class="breadcrumb-item active">Create Images</li>
    </ol>
@endsection

@section('javascript')

    <script>
         $(document).ready(function() {
            $('.select2').select2();
        });

    </script>
@endsection