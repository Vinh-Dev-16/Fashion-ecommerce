@extends('admin.layout')

@section('title')
    Trang sản phẩm
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Sản phẩm</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Trang chủ</h6>
@endsection
@section('content')

    {{--     Content --}}
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Bảng sản phẩm</h6>
            <div class="mb-4 mt-4 d-flex align-items- justify-content-between">
                @can('create-product')
                    <a class="btn bg-gradient-dark mb-0" id="create-product">
                        <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;
                        Thêm sản phẩm</a>
                @endcan
                <div class="input-group d-flex justify-content-end" style="width: 300px">
                    <span class="input-group-text text-body"  ><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" id="search-product" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0" id="show-data">
                @include('admin.product.list_data')
            </div>
            <!-- /.card-body -->
        </div>
        <div id="modal-create">

        </div>
    </div>

@endsection


@section('javascript')
   @include('admin.product.script')
@endsection
