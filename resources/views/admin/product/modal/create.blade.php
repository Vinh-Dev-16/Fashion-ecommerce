<div class="modal fade" id="modal-create-product" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
             style="z-index:10000000; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
            <div class="modal-header" style="background: #5e72e4">
                <h4 class="modal-title" style="color: white" id="myModalLabel">Thêm sản phẩm</h4>
                <button
                    class="close-modal btn btn-icon-only btn-rounded btn-outline-white mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
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
                                <input type="text" id="examplePrice" name="price"
                                       placeholder="Điền giá sản phẩm" class="form-control"
                                       data-type="currency">
                                <div class="text-danger error-text price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleWeight">Cân nặng
                                    <span>
                                        <span style="color: red">*</span>
                                        <small>Đơn vị tính theo gram</small>
                                    </span>
                                </label>
                                <input type="text" class="form-control" id="exampleWeight" name="weight"
                                       placeholder="Điền cân nặng sản phẩm">
                                <div class="text-danger error-text weight_error"></div>
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
    <div class="overlay-modal"></div>
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
    document.addEventListener('click', function (e) {
        e.target.classList.contains('overlay-modal') ? $('#modal-create-voucher').modal('hide') : false;
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
                weight: $('input[name=weight]').val(),
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
                        createSuccess('Thêm sản phẩm thành công!');
                }
            },
            error: function (error) {
                createToast('Thêm sản phẩm thất bại!')
            }
        });
    }
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") { return; }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            // if (blur === "blur") {
            //     right_side += "00";
            // }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val =  input_val;

            // final formatting
            // if (blur === "blur") {
            //     input_val += ".00";
            // }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
    //     end format money
</script>
