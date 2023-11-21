<div class="modal fade" id="modal-edit-voucher" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
             style="z-index:10000000; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
            <div class="modal-header" style="background: #5e72e4">
                <h4 class="modal-title" style="color: white" id="myModalLabel">Thêm thương hiệu</h4>
                <button
                    class="close-modal btn btn-icon-only btn-rounded btn-outline-white mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="card-body px-3 pt-2 pb-2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleValue">Tên mã giảm giá</label>
                                <input type="text" class="form-control"
                                       placeholder="Điền tên mã giảm giá" name="value" value="{{$voucher->value}}">
                                <div class="text-danger error-text value_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleQuantity">Số lượng</label>
                                <input type="text" class="form-control"
                                       placeholder="Số lượng" name="quantity" value="{{$voucher->quantity}}">
                                <div class="text-danger error-text quantity_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePercent">% giảm giá
                                    <span>
                                        <span style="color: red">*</span>
                                        <small>Chỉ nhập 1 trong 2 (% hoặc giá tiền)</small>
                                    </span>
                                </label>
                                <input type="text" class="form-control"
                                       placeholder="% giảm giá" name="percent" value="{{$voucher->percent}}">
                                <div class="text-danger error-text percent_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Tiền giảm giá
                                    <span>
                                        <span style="color: red">*</span>
                                        <small>Chỉ nhập 1 trong 2 (% hoặc giá tiền)</small>
                                    </span>
                                </label>
                                <input type="text" class="form-control"
                                       placeholder="% giảm giá" data-type="currency" name="price"
                                       value="{{$voucher->price}}">
                                <div class="text-danger error-text price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleMax">Tối đa</label>
                                <input type="text" class="form-control"
                                       placeholder="Nhập số tiền" data-type="currency" name="max"
                                       value="{{$voucher->max}}">
                                <div class="text-danger error-text max_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleType">Phân loại</label>
                                <br>
                                <select name="type" style="width: 100%; height: 37px">
                                    <option>Phân loại giảm giá</option>
                                    <option value="0"
                                            @if($voucher->type == 0) selected @endif>Mã Ship
                                    </option>
                                    <option value="1"
                                            @if($voucher->type == 0)
                                                selected
                                        @endif
                                    >Mã giảm giá đơn hàng
                                    </option>
                                </select>
                                <div class="text-danger error-text type_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleMinPrice">Đơn hàng tối thiểu</label>
                                <input type="text" class="form-control price_format"
                                       placeholder="Nhập số tiền" data-type="currency" name="min_price"
                                       value="{{$voucher->min_price}}">
                                <div class="text-danger error-text min_price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleStartDate">Ngày bắt đầu</label>
                                <input type="date" class="form-control"
                                       name="start_date" value="{{$voucher->start_date}}">
                                <div class="text-danger error-text start_date_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleStartDate">Ngày kết thúc</label>
                                <input type="date" class="form-control"
                                       name="end_date" value="{{$voucher->end_date}}">
                                <div class="text-danger error-text end_date_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="examplePrice">Brand được giảm giá</label>
                                <select name="brand_id[]" class="tag_multiple" style="width: 100%" multiple>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                        @if(in_array($brand->id, $voucher->brands->pluck('id')->toArray())) @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-text brand_id_error"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-create-voucher">Tạo mới</button>
            </div>
        </div>
    </div>
    <div class="overlay-modal"></div>
</div>

<script defer>
    $(document).ready(function () {
        $('.tag_multiple').select2(
            {
                placeholder: "Chọn thương hiệu",
                allowClear: true,
                closeOnSelect: false,
            }
        );
    });


    $('.close-modal').click(function () {
        $('#modal-edit-voucher').modal('hide');
    });
    document.addEventListener('click', function (e) {
        e.target.classList.contains('overlay-modal') ? $('#modal-create-voucher').modal('hide') : false;
    });
    $('.btn-create-voucher').click(function () {
        var page = $(this).attr('data-page');
        $.ajax({
            url: '{{ route('admin.voucher.update') }}',
            method: 'POST',
            data: {
                value: $('input[name="value"]').val(),
                quantity: $('input[name="quantity"]').val(),
                percent: $('input[name="percent"]').val(),
                price: $('input[name="price"]').val(),
                max: $('input[name="max"]').val(),
                min_price: $('input[name="min_price"]').val(),
                start_date: $('input[name="start_date"]').val(),
                end_date: $('input[name="end_date"]').val(),
                type: $('select[name="type"]').val(),
                brand_id: $('select[name="brand_id[]"]').val(),
                id: '{{$voucher->id}}',
                page: page,
            },
            beforeSend: function () {
                $(document).find('div.text-danger').text('');
            }, success: function (data) {
                switch (data.status) {
                    case 0:
                        $.each(data.message, function (prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                        });
                        break;
                    case 1:
                        $('#modal-edit-voucher').modal('hide');
                        list_data(data.url);
                        createSuccess(data.message);
                        break;
                    case 2:
                        createToast(data.message);
                        break;
                }
            },
            error: function (error) {
                createToast(error);
            }
        })
    });

    //     format money

    // Jquery Dependency

    $("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
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
        if (input_val === "") {
            return;
        }

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
            input_val = input_val;

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
