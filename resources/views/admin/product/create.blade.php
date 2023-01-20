@extends('admin.layout')
@section('title')
    Tạo mới product
@endsection
@section('content')
    @if (Session::has('loi'))
        <div class='noti ' style="top: 43px;right:8px">
            <h2> Thông báo lỗi </h2>
            <p> Đã lỗi về thứ gì đó </p>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card product">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TẠO MỚI PRODUCT</h2>
                </div>
                <div class="card card-primary">
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
                                <input type="text" class="form-control" id="convert_slug"
                                  name="slug">
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
                                <select name="id_category[]" class="form-control selectpicker" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                </select>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Brand sản phẩm</label>
                                <select name="brand_id" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleThumbnail">Ảnh sản phẩm</label>
                                <input type="text" class="form-control" name="thumbnail" placeholder="Điền ảnh sản phẩm">
                                @error('thumbnail')
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
                                <label for="exampleStock">Số tồn kho</label>
                                <input type="text" class="form-control" id="exampleInputStock" name="stock"
                                    placeholder="Điền số lượng hàng tồn kho">
                                @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleStock">Tag sản phẩm</label>
                                <input type="text" class="form-control" data-role="tagsinput" name="tag">
                                @error('tag')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleDesce">Thông tin sản phẩm</label>
                                <textarea type="text" class="form-control" id="exampleInputDesce" name="desce"
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
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.product.index') }}">Product</a></li>
        <li class="breadcrumb-item active">Create Products</li>
    </ol>
@endsection

@section('javascript')

    {{-- CDN Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- CDN jquery --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>


    {{-- Search input category --}}
    <script>
        $(document).ready(function() {
            $("#search").keyup(function() {
                var input = $(this).val();
                console.log(1);
                // if (input != "") {
                //   $.ajax({
                //     url: "{{ URL::to('store') }}",
                //     method: "POST",
                //     data: {
                //       input: input
                //     },
                //     success: function(data) {
                //       $("#search_result").html(data);
                //     }
                //   });
                // } else {
                //   $("#search_result").html("");
                // }
            })
        })

        // Slug
 function ChangeToSlug()
     {
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
