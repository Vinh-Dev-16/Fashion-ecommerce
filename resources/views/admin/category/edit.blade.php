@extends('admin.layout')
@section('title')
    Trang sửa danh mục
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
                href="{{route('admin.category.index')}}" class="opacity-5 text-white>"></a>Danh mục
        </li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Sửa danh mục</h6>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Sửa danh mục</h6>
        </div>
        @can('edit-category')
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('admin/category/update/' . $categories->id) }}" method="POST">
                @csrf
                <div class="card-body px-3 pt-2 pb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleName">Tên loại sản phẩm</label>
                            <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                   value="{{ $categories->name }}" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Slug sản phẩm</label>
                            <input type="text" value="{{$categories->slug}}" class="form-control" id="convert_slug"
                                   name="slug">
                            @error('slug')
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
                    </div>
                </div>
            </form>
        @endcan
    </div>
@endsection


@section('javascript')
    @include('admin.category.script')
@endsection
