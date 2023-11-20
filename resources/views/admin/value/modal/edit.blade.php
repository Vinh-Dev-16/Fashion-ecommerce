@extends('admin.layout')
@section('title')
Trang sửa Attribute Value
@endsection
@section('content')
    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA Value</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/value/update/' . $values->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên giá trị thuộc tính</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{ $values->value }}" name="value">
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Tên attriute </label>
                                <select name="attribute_id" class="form-control" >
                                        @foreach ($attributes as $attribute)
                                            <option @if ($values->attribute_id == $attribute->id) selected @endif value="{{ $attribute->id}}">{{ $attribute->value }}</option>
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
        <li class="breadcrumb-item "><a href="{{ route('admin.value.index') }}">Attribute Value</a></li>
        <li class="breadcrumb-item active">Edit Attribute Value</li>
    </ol>
@endsection

@section('javascript')
    
@endsection
