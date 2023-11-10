<div class="modal fade" id="modal-create-attribute" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
             style="z-index:10000000; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
            <div class="modal-header" style="background: #5e72e4">
                <h4 class="modal-title" style="color: white" id="myModalLabel">Thêm thuộc tính</h4>
                <button
                    class="close-modal btn btn-icon-only btn-rounded btn-outline-white mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleName">Tên attriute</label>
                            <input type="text" class="form-control" id="exampleInputName"
                                   placeholder="Điền tên attriute" name="value">
                            <div class="text-danger error-text value_error"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-create-attribute">Tạo mới</button>
            </div>
        </div>
    </div>
    <div class="overlay-modal"></div>
</div>

<script defer>
    $('.close-modal').click(function () {
        $('#modal-create-attribute').modal('hide');
    });

    $('.btn-create-attribute').click(function () {
        var page = $(this).attr('data-page');
        $.ajax({
            url: '{{ route('admin.attribute.store') }}',
            method: 'POST',
            data: {
                value: $('#exampleInputName').val(),
                page: page,
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
                        $('#modal-create-attribute').modal('hide');
                        list_data(data.url)
                        createSuccess(data.message);
                        break;
                    case 2:
                        $('#modal-create-attribute').modal('hide');
                        createToast(data.message);
                }
            },
            error: function (error) {
                createToast(error);
            }
        })
    })

</script>

