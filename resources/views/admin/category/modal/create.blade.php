<div class="modal fade" id="modal-create-category" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thêm danh mục</h4>
                <button
                    class="close-modal btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="card-body px-3 pt-2 pb-2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleName">Tên danh mục</label>
                                <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                       placeholder="Điền tên danh mục" name="name">
                                <div class="text-danger error-text name_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Slug danh mục</label>
                                <input type="text" class="form-control" id="convert_slug" name="slug">
                                <div class="text-danger error-text slug_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Cha danh mục</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0"> None</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-text parent_id_error"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-create-category">Tạo mới</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.close-modal').click(function () {
        $('#modal-create-category').modal('hide');
    });
    $(document).ready(function () {
        $('.select2').select2();

        $('.tag_multiple').select2({
            theme: "classic",
            tags: true,
        });
    });

    $('.btn-create-category').click(function () {
        $.ajax({
            url: '{{ route('admin.category.store') }}',
            method: 'POST',
            data: {
                name: $('#slug').val(),
                slug: $('#convert_slug').val(),
                parent_id: $('#parent_id').val(),
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
                        $('#modal-create-category').modal('hide');
                        createSuccess(data.message);
                        let url = $(this).attr('href');
                        list_data(url);
                        break;
                    case 2:
                        $('#modal-create-category').modal('hide');
                        createToast(data.message);
                }
            },
        })
    })

</script>
