@extends('admin.layout')

@section('title')
    Trang role
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Role</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Trang chủ</h6>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Role table</h6>
            <div class="mb-4 mt-4">
                @can('create-role')
                    <a class="btn bg-gradient-dark mb-0" href="{{url('admin/role/create')}}"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Thêm role</a>
                @endcan
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Role</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Permission</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  opacity-7">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                <p class="text-xs text-center  mb-0" style="width:38%" >{{$role->id}}</p>
                            </td>
                            <td>
                                <p class="text-xs ms-3 mb-0" >{{$role->name}}</p>
                            </td>
                            <td class="align-middle text-sm">
                                @if ($role->permissions->count() > 0)
                                    <div class="d-flex" style="flex-wrap: wrap; gap:5px">
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge badge-sm bg-gradient-success">{{$permission->name}}
                                        </span>
                                            <br>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge badge-sm bg-gradient-success">Không có</span>
                                @endif
                            </td>
                            <td class="align-middle text-center ms-auto text-end">
                                @can('delete-role')
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirmation(this)"  href="{{url('admin/role/destroy/'. $role->id)}}"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a>
                                @endcan
                                @can('edit-role')
                                    <a class="btn btn-link text-dark px-3 mb-0" href="{{url('admin/role/edit/'. $role->slug)}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$roles->links('vendor.pagination.bootstrap-4')}}

@endsection

@section('javascript')
    <script>
        function confirmation(eve) {
            let url = eve.getAttribute('href');
            console.log(url);
            swal({
                title: 'Bạn có chắc là xóa nó chứ?',
                text: 'Bạn có thể restore nó',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
                .then((willCancle)=>{
                    if (willCancle) {
                        window.location.href = url;
                    }
                })
            return false;
        }
    </script>
@endsection
