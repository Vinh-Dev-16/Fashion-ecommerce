@extends('admin.layout')

@section('title')
    Trang người dùng
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">User</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Trang chủ</h6>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>User table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên người dùng</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vai trò</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Công cụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <p class="text-xs text-center  mb-0" style="width:38%" >{{$i++}}</p>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        @if($user->avatar != null)
                                            <img src="{{asset('storage/avatar/' . $user->avatar)}}" class="avatar avatar-sm me-3" alt="user{{$i++}}">
                                            @else
                                            <img src="{{assert('css/img/team-1.jpg')}}" class="avatar avatar-sm me-3" alt="user{{$i++}}">
                                        @endif

                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                        <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-sm">
                                @foreach($user->roles as $role)
                                    <span class="badge badge-sm bg-gradient-success">{{$role->name}}
                                     </span>
                                @endforeach
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs"><a href="{{url('admin/user/role/' . $user->id)}}">Phân role</a></span>
                                <br>
                                <span class="text-secondary text-xs"><a href="{{url('admin/user/permission/' . $user->id)}}">Phân permision</a></span>
                                <br>
                                <span class="btn btn-link text-danger text-gradient px-3 mb-0"><a href="{{url('admin/user/destroy/' . $user->id)}}" onclick="return confirmation(this)"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa người dùng</a></span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$users->links('vendor.pagination.bootstrap-4')}}
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
                .then((willCancle) => {
                    if (willCancle) {
                        window.location.href = url;
                    }
                })
            return false;
        }
    </script>
@endsection
