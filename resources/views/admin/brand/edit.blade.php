@extends('admin.layout')
@section('title')
    Trang sửa Brand
@endsection
@section('content')


    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">SỬA BRAND</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('admin/brand/update/' . $brand->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên brand sản phẩm</label>
                                <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()" value="{{ $brand->name }}"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Slug brand</label>
                                <input type="text" class="form-control" value="{{$brand->slug}}" id="convert_slug" name="slug">
                                @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Logo brand</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                    value="{{$brand->logo}}" name="logo" >
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                                <label for="exampleName">Chi tiết Brand</label>
                                <textarea type="text" class="form-control" id="editor" name="description"
                                    placeholder="Điền thông tin sản phẩm"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Voucher</label>
                                <select class="tag_multiple" name="value[]" multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($products->vouchers as $voucher)
                                        <option value="{{$voucher->value}}" selected> {{$voucher->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Giá Voucher</label>
                                <select class="tag_multiple" name="percent[]" multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($products->vouchers as $voucher)
                                        <option value="{{$voucher->percent}}" selected> {{$voucher->percent}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Số lượng Voucher</label>
                                <select class="tag_multiple" name="quantity[]" multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($products->vouchers as $voucher)
                                        <option value="{{$voucher->quantity}}" selected> {{$voucher->quantity}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.brand.index') }}">Brand</a></li>
        <li class="breadcrumb-item active">Edit Brand</li>
    </ol>
@endsection

@section('javascript')

    @include('admin.brand.script')

@endsection
