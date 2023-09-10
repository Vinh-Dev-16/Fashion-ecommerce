@extends('admin.layout')

@section('title')
    Thêm Permissions
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a href="{{url('admin.permission.index')}}" class="opacity-5 text-white>"></a>Permission</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Thêm Permission</h6>
@endsection
@section('content')
    @can('create-permission')
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Thêm Permission</h6>
            </div>
            <form action="{{url('admin/permission/store')}}" method="POST">
                @csrf
                <div class="card-body px-3 pt-2 pb-2">
                    <div class="form-group">
                        <label for="exampleName">Permission</label>
                        <input type="text" class="form-control"
                               placeholder="Thêm Permission" name="name" id="slug" onkeyup="ChangeToSlug();">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleName">Slug</label>
                        <input type="text" class="form-control"
                               placeholder="slug" name="slug" id="convert_slug">
                        @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleName">Role</label>
                        <select class="select2" name="role_id[]" multiple="multiple"
                                style="width: 100%">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            @endcan
        </div>

        @endsection
        @section('javascript')
            <script>
                $(document).ready(function() {
                    $('.select2').select2();

                    $('.tag_multiple').select2({
                        theme: "classic",
                        tags: true,
                    });
                });
            </script>
        @endsection
