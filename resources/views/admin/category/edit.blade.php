@extends('admin.layout')
@section('title')
    Trang sửa Category
@endsection
@section('content')

    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA CATEGORY</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/category/update/' . $categories->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên loại sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{ $categories->name }}" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleName">Bố danh mục</label>
                                   <select class="form-control" name="parent_id">
                                    <option value="0"> None</option>
                                    @foreach ($category as $category)
                                      <option @if ($category->id == $categories->parent_id)
                                            selected                                      
                                        @endif value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                   </select>
                                @error('parent_id')
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
        <li class="breadcrumb-item "><a href="{{ route('admin.category.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>
@endsection


