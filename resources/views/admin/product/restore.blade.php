@extends('admin.layout')
@section('title')
    Trang restore
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12">
        <div class="restore">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN RESTORE</h2>
                    <h3 class="card-title">
                        <a href="{{ route('admin.product.index') }}">Quay lại trang product</a>
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" id="search" class="form-control float-right"
                                placeholder="Search">
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
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Giảm giá</th>
                                <th>Tồn kho</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="infor_restore">
                            <tr>
                                @foreach ($restores as $restore)
                                    <td>{{ $restore->id }}</td>
                                    <td>{{ Illuminate\Support\Str::of($restore->name)->words(4) }}</td>
                                    <td>{{ number_format($restore->price) }} VND</td>
                                    <td>{{ $restore->discount }}%</td>
                                    <td>{{ $restore->stock }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">

                                        <a href="{{ url('admin/product/restore/' . $restore->id) }}" title="Restore"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-rotate-left" style="color: black; font-size:22px;"></i></a>
                                        <form method="post" action="{{ url('admin/product/delete/' . $restore->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa restore"
                                                onclick=" return confirm ('Bạn có muốn xóa không?')"
                                                style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                    class="fa-solid fa-trash"
                                                    style="color: #f4f4f; font-size:22px;"></i></button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="search_result"></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{ $restores->links() }}
        <div class="item"></div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Restore restores</li>
    </ol>
@endsection