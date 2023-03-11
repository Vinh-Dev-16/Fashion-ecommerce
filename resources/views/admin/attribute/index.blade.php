@extends('admin.layout')
@section('title')
    Trang attribute
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12" style="display:flex;align-items: center;justify-content:center">
        <div class="product col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN ATTRIBUTE</h2>
                    <h3 class="card-title"><a href="{{ route('admin.attribute.create') }}">Tạo mới attribute</a></h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                                <th>Tên attribute</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($attributes as $attribute)
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->value }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:flex-start;">
                                        <a href="{{ url('admin/attribute/edit/' . $attribute->id) }}" title="Sửa attribute"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color:black; font-size:25px;"></i></a>
                                        <form method="post"
                                            action="{{ url('admin/attribute/destroy/' . $attribute->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa attribute"
                                                onclick=" return confirm ('Bạn có muốn xóa không?')"
                                                style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                    class="fa-solid fa-trash"
                                                    style="color: black; font-size:25px;"></i></button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex;justify-content: center;
      align-items: center;">
        {{ $attributes->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Attribute</li>
    </ol>
@endsection

