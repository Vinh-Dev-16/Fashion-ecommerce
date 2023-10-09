<div class="modal fade" id="modal-create-brand" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
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
                                <label for="exampleName">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                       placeholder="Điền tên brand" name="name">
                                <div class="text-danger error-text name_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Slug thương hiệu</label>
                                <input type="text" class="form-control" id="convert_slug" name="slug">
                                <div class="text-danger error-text slug_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Logo thương hiệu</label>
                                <input type="text" class="form-control" id="exampleInputName"
                                       placeholder="Link logo brand" name="logo">
                                <div class="text-danger error-text logo_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleDesce">Chi tiết thương hiệu</label>
                                <textarea type="text" class="form-control" id="editor" name="description"
                                          placeholder="Điền thông tin sản phẩm"></textarea>
                                <div class="text-danger error-text description_error"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-create-brand">Tạo mới</button>
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
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    $('.close-modal').click(function () {
        $('#modal-create-brand').modal('hide');
    });
    $('.btn-create-brand').click(function () {
        var page = $(this).attr('data-page');
        $.ajax({
            url: '{{ route('admin.brand.store') }}',
            method: 'POST',
            data: {
                name: $('#slug').val(),
                slug: $('#convert_slug').val(),
                logo: $('input[name="logo"]').val(),
                value: $('select[name="value[]"]').val(),
                percent: $('select[name="percent[]"]').val(),
                quantity: $('select[name="quantity[]"]').val(),
                description: editor.getData(),
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
                        $('#modal-create-voucher').modal('hide');
                        list_data(data.url)
                        createSuccess(data.message);
                        break;
                    case 2:
                        $('#modal-create-voucher').modal('hide');
                        createToast(data.message);
                }
            },
            error: function (error) {
                createToast(error);
            }
        })
    })
</script>
