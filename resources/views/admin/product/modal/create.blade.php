<div class="modal fade" id="modal-create-product" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thêm sản phẩm</h4>
                <button
                    class="close-modal btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="card-body px-3 pt-2 pb-2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                       placeholder="Điền tên sản phẩm" name="name">
                                <div class="text-danger error-text name_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Slug sản phẩm</label>
                                <input type="text" class="form-control" id="convert_slug" name="slug">
                                <div class="text-danger error-text slug_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="examplePrice" name="price"
                                       placeholder="Điền giá sản phẩm" class="format_money">
                                <div class="text-danger error-text price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Category sản phẩm</label>
                                <select class="select2" name="id_category[]" id="categories_select"
                                        multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-text id_category_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Brand sản phẩm</label>
                                <select name="brand_id" class="select2" style="width: 100%">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-text brand_id_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Size sản phẩm</label>
                                <select class="select2" name="attribute_value_id[]" multiple="multiple"
                                        style="width: 100%">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->value }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-text attribute_value_id_error"></div>
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-create-product">Tạo mới</button>
            </div>
        </div>
    </div>
</div>

<script defer>

    $(document).ready(function () {
        $('.select2').select2();

        $('.tag_multiple').select2({
            theme: "classic",
            tags: true,
        });
    });
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
    $('.close-modal').click(function () {
        $('#modal-create-product').modal('hide');
    });

    $('.btn-create-product').click(function () {
        create_product();
    })

    function create_product() {
        $.ajax({
            url: '{{ route('admin.product.store') }}',
            method: 'POST',
            data: {
                name: $('input[name=name]').val(),
                slug: $('input[name=slug]').val(),
                price: $('input[name=price]').val(),
                id_category: $('#categories_select').val(),
                brand_id: $('select[name=brand_id]').val(),
                attribute_value_id: $('select[name=attribute_value_id]').val(),
                discount: $('input[name=discount]').val(),
                sale: $('select[name=sale]').val(),
                path: $('select[name=path]').val(),
                material: $('select[name=material]').val(),
                tags: $('input[name=tags]').val(),
                stock: $('input[name=stock]').val(),
                desce: editor.getData(),
            },
            beforeSend: function () {
                $(document).find('div.text-danger').text('');
            },
            success: function (data) {
                switch (data.status) {
                    case 0:
                        $.each(data.message, function (prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                        });
                        break;
                    case 1:
                        $('#modal-create-product').modal('hide');
                        let url = $(this).attr('href');
                        list_data(url);
                        createSuccess('Thêm sản phẩm thành công!');
                }
            },
            error: function (error) {
                createToast('Thêm sản phẩm thất bại!')
            }
        });
    }

</script>
