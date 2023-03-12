@extends('admin.layout')
@section('title')
    Trang Restore User
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12" style="display:flex;align-items: center;justify-content:center">
        <div class="product col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN USER</h2>
                    <h3 class="card-title"><a href="{{ route('admin.account.index') }}">Quay lại trang User</a></h3>
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
                                <th>Tên người dùng</th>
                                <th>Email người dùng</th>
                                <th>Vai trò</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($restores as $restore)
                                    <td>{{ $restore->id }}</td>
                                    <td>{{ $restore->name }}</td>
                                    <td>{{ $restore->email }}</td>
                                    <td>{{ $restore->roles->name }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:flex-start;">

                                        <a href="{{ url('admin/account/restore/' . $restore->id) }}" title="Sửa restore"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color: green; font-size:25px;"></i></a>
                                        <a href="{{ url('admin/account/delete' . $restore->id) }}" type="submit"
                                            title="Xóa restore" onclick=" return confirm ('Bạn có muốn xóa không?')"
                                            style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                class="fa-solid fa-trash" style="color: red; font-size:25px;"></i><a>
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
        {{ $restores->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Restore restore</li>
    </ol>
@endsection

