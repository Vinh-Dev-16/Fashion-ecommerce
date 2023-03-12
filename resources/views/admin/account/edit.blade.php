@extends('admin.layout')
@section('title')
    Trang sửa role User
@endsection
@section('content')
   

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA ACCOUNT</h2>
            </div>
            <div class="card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form sửa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/account/update/' . $accounts->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleName">Role người dùng </label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('breadcumb')
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ route('admin.account.index') }}">Account</a></li>
            <li class="breadcrumb-item active">Edit Account</li>
        </ol>
    @endsection
 