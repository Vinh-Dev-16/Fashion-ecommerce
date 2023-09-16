@extends('admin.layout')
@section('title')
    Trang sửa sản phẩm
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                               href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
                href="{{url('admin.product.index')}}" class="opacity-5 text-white>"></a>Permission
        </li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Sửa sản phẩm</h6>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Sửa sản phẩm</h6>
        </div>
        @can('edit-product')
            <form action="{{url('admin/product/update/'. $product->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body px-3 pt-2 pb-2">
                    <div class="form-group">
                        <label for="exampleName">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="slug"
                               value="{{ $product->name }}" name="name" onkeyup="ChangeToSlug();">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleName">Slug sản phẩm</label>
                        <input type="text" class="form-control" id="convert_slug" name="slug"
                               value="{{$product->slug}}">
                        @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="examplePrice" name="price"
                               value="{{ $product->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Category sản phẩm</label>
                        <select name="id_category[]" class="select2" id="select2" multiple="multiple"
                                style="width: 100%">
                            @foreach ($selects as $id=>$name)
                                <option selected value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('id_category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Brand sản phẩm</label>
                        <select name="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option @if ($product->brand_id == $brand->id) selected
                                        @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Size sản phẩm</label>
                        <select class="select2" name="attribute_value_id[]" multiple="multiple"
                                style="width: 100%">
                            @foreach ($product->attributevalues as $select)
                                @if ($select->attributes->id == 1)
                                    <option selected value="{{$select->id}}">{{$select->value}}</option>
                                @endif
                            @endforeach
                            @foreach ($sizes as $size)
                                <option
                                    value="{{ $size->id }}">{{ $size->value }}</option>
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
                            @foreach ($product->attributevalues as $select)
                                @if ($select->attributes->id == 2)
                                    <option selected value="{{$select->id}}">{{$select->value}}</option>
                                @endif
                            @endforeach
                            @foreach ($colors as $color)
                                <option
                                    value="{{ $color->id }}">{{ $color->value }}</option>
                            @endforeach
                        </select>
                        @error('attribute_value_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleDiscount">% giảm giá</label>
                        <input type="text" class="form-control" id="exampleInputDiscount" name="discount"
                               value="{{ $product->discount }}">
                        @error('discount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleSale">Sản phẩm Sale</label>
                        <select class="form-control" name="sale">
                            <option @if ($product->sale == 1) selected @endif value="1">Sale</option>
                            <option value="0">Không sale</option>
                        </select>
                        @error('sale')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Ảnh sản phẩm</label>
                        <select class="tag_multiple" name="path[]" multiple="multiple"
                                style="width: 100%">
                            @foreach ($product->images as $image)
                                <option value="{{$image->path}}" selected> {{$image->path}}</option>
                            @endforeach
                        </select>
                        @error('path')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="examplePrice">Chất liệu sản phẩm</label>
                        <select class="tag_multiple" name="material[]" multiple="multiple"
                                style="width: 100%">
                            @foreach ($product->materials as $material)
                                <option value="{{$material->name}}" selected> {{$material->name}}</option>
                            @endforeach
                        </select>
                        @error('material')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleTags">Tag sản phẩm</label>
                        <input type="text" class="form-control" id="exampleTags"
                               value="{{$product->tags}}" name="tags">
                        @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleStock">Số tồn kho</label>
                        <input type="text" class="form-control" id="exampleInputStock" name="stock"
                               value="{{ $product->stock }}">
                        @error('stock')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleDesce">Thông tin sản phẩm</label>
                        <input type="text" class="form-control" name="desce"
                               value="{{ $product->desce }}">
                        @error('desce')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        @endcan
    </div>
@endsection


@section('javascript')
    {{-- Search input category --}}

    <script>

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                return console.error(error);
            });

        $(document).ready(function () {
            $('.select2').select2();
            $('.tag_multiple').select2({
                theme: "classic",
                tags: true,
            });
        });

    </script>
@endsection
