@extends('admin.layout')
@section('title')
    Tạo mới product
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
                href="{{route('admin.product.index')}}" class="opacity-5 text-white>"></a>Role
        </li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Thêm sản phẩm</h6>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Sửa sản phẩm</h6>
        </div>
        @can('create-product')
            <form action="{{route('admin.product.create')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body px-3 pt-2 pb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleName">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                   placeholder="Điền tên sản phẩm" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Slug sản phẩm</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug">
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="examplePrice">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="examplePrice" name="price"
                                       placeholder="Điền giá sản phẩm" class="format_money">
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="examplePrice">Category sản phẩm</label>
                                <select class="select2" name="id_category[]" id="categories_select" multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="examplePrice">Brand sản phẩm</label>
                                <select name="brand_id" class="select2" style="width: 100%">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Size sản phẩm</label>
                            <select class="select2" name="attribute_value_id[]" multiple="multiple"
                                    style="width: 100%">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->value }}</option>
                                @endforeach
                            </select>
                            @error('attribute_value_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Màu sản phẩm</label>
                            <select class="select2" name="attribute_value_id[]" multiple="multiple"
                                    style="width: 100%">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->value }}</option>
                                @endforeach
                            </select>
                            @error('attribute_value_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleDiscount">% giảm giá</label>
                            <input type="text" class="form-control" id="exampleInputDiscount" name="discount"
                                   placeholder="Điền % giảm giá">
                            @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSale">Sản phẩm Sale</label>
                            <select class="form-control" name="sale">
                                <option selected value="0">Không sale</option>
                                <option value="1">Sale</option>
                            </select>
                            @error('sale')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Ảnh sản phẩm</label>
                            <select class="tag_multiple" name="path[]" multiple="multiple"
                                    style="width: 100%">
                            </select>
                            @error('path')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Chất liệu sản phẩm</label>
                            <select class="tag_multiple" name="material[]" multiple="multiple"
                                    style="width: 100%">
                            </select>
                            @error('material')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleTags">Tag sản phẩm</label>
                            <input type="text" class="form-control" id="exampleTags" name="tags">
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleStock">Số tồn kho</label>
                            <input type="text" class="form-control" id="exampleInputStock" name="stock"
                                   placeholder="Điền số lượng hàng tồn kho">
                            @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleDesce">Thông tin sản phẩm</label>
                            <textarea rows="3" type="text" class="form-control" id="editor" name="desce"
                                      placeholder="Điền thông tin sản phẩm"></textarea>
                            @error('desce')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
        @endcan
        </div>
    </div>
@endsection


@section('javascript')
    {{-- Search input category --}}
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('.tag_multiple').select2({
                theme: "classic",
                tags: true,
            });
        });
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });


    </script>
@endsection
