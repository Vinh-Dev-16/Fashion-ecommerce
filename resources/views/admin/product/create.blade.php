@extends('admin.layout')
@section('title')
    Tạo mới product
@endsection
@section('content')

    <div class="col-md-12">
        <div class="product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TẠO MỚI PRODUCT</h2>
                </div>
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tạo mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.product.store') }}" method="POST">
                        @csrf
                        @method('POST')
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
                            <div class="form-group">
                                <label for="examplePrice">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="examplePrice" name="price"
                                    placeholder="Điền giá sản phẩm" class="format_money">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
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
                                <label for="examplePrice">Voucher</label>
                                <select class="tag_multiple" name="value[]" multiple="multiple"
                                    style="width: 100%">
                                </select>
                                @error('value')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Giá Voucher</label>
                                <select class="tag_multiple" name="percent[]" multiple="multiple"
                                    style="width: 100%">
                                </select>
                                @error('percent')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Số lượng Voucher</label>
                                <select class="tag_multiple" name="quantity[]" multiple="multiple"
                                    style="width: 100%">
                                </select>
                                @error('quantity')
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
                                <textarea type="text" class="form-control" id="editor" name="desce"
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.product.index') }}">Product</a></li>
        <li class="breadcrumb-item active">Create Products</li>
    </ol>
@endsection

@section('javascript')
    {{-- Search input category --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            
             $('.tag_multiple').select2({
             theme: "classic",
             tags: true,
             });
        });

        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
            // Slug
            function ChangeToSlug() {
                var slug;

                //Lấy text từ thẻ input title 
                slug = document.getElementById("slug").value;
                slug = slug.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
                document.getElementById('convert_slug').value = slug;
            }
    </script>
@endsection
