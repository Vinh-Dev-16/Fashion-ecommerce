@extends('admin.layout')
@section('title')
    Trang sửa Image
@endsection
@section('content')

    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA IMAGE</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/images/update/' . $images->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên path ảnh</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{ $images->path }}" name="path">
                            </div>

                            <div class="form-group">
                                <label for="exampleName">Bố danh mục</label>
                                   <select class="form-control" name="product_id">
                                    @foreach ($products as $product)
                                      <option @if ($images->product_id == $product->id)
                                            selected                                      
                                        @endif value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
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
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.images.index') }}">Images</a></li>
        <li class="breadcrumb-item active">Edit Images</li>
    </ol>
@endsection


