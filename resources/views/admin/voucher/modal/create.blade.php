<div class="modal fade" id="modal-create-voucher" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
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
                                       placeholder="Điền tên mã giảm giá" name="value">
                                <div class="text-danger error-text value_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleQuantity">Số lượng</label>
                                <input type="text" class="form-control"
                                       placeholder="Số lượng" name="quantity">
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
                                       placeholder="% giảm giá" name="percent">
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
                                       placeholder="% giảm giá" name="price">
                                <div class="text-danger error-text price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleMax">Tối đa</label>
                                <input type="text" class="form-control"
                                       placeholder="Nhập số tiền" name="max">
                                <div class="text-danger error-text max_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleMinPrice">Số hàng tối thiểu</label>
                                <input type="text" class="form-control"
                                       placeholder="Nhập số tiền" name="min_price">
                                <div class="text-danger error-text min_price_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleStartDate">Ngày bắt đầu</label>
                                <input type="date" class="form-control"
                                       name="start_date">
                                <div class="text-danger error-text start_date_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleStartDate">Ngày kết thúc</label>
                                <input type="date" class="form-control"
                                       name="end_date">
                                <div class="text-danger error-text end_date_error"></div>
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
        $('.tag_multiple').select2({
            theme: "classic",
            tags: true,
        });
    });
    $('.close-modal').click(function () {
        $('#modal-create-voucher').modal('hide');
    });

    $('.btn-create-voucher').click(function () {
        var page = $(this).attr('data-page');
        $.ajax({
            url: '{{ route('admin.voucher.store') }}',
            method: 'POST',
            data: {
                value: $('input[name="value"]').val(),
                quantity: $('input[name="quantity"]').val(),
                percent: $('input[name="percent"]').val(),
                price: $('input[name="price"]').val(),
                max: $('input[name="max"]').val(),
                start_date: $('input[name="start_date"]').val(),
                end_date: $('input[name="end_date"]').val(),
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
                        $('#modal-create-voucher').modal('hide');
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

</script>
