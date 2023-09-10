@extends('admin.layout')

@section('title')
    Phân vai trò
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a href="{{url('admin.user.index')}}" class="opacity-5 text-white>"></a>User</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Phân vai trò</h6>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Phân Role</h6>
        </div>
        <form action="{{url('admin/user/doRole/' . $user->id)}}" method="POST">
            @csrf
            <div class="card-body px-3 pt-2 pb-2">
                <div class="form-group">
                    @foreach($roles as $role)
                        <input
                            @foreach($user->roles as $item)
                                @if($item->id == $role->id)
                                    checked
                            @endif
                            @endforeach
                            type="radio" value="{{$role->id}}" id="{{$role->name}}" name="role_id">
                        <label class="me-3" for="{{$role->name}}">{{$role->name}}</label>
                    @endforeach
                    @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
