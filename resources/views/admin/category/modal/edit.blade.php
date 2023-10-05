<div class="modal fade" id="modal-edit-category" style="--bs-modal-width:50%" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #5e72e4">
                <h4 class="modal-title" style="color: white" id="myModalLabel">Sửa danh mục</h4>
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
                            <label for="exampleName">Tên danh mục</label>
                            <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                   value="{{ $category->name }}" name="name">
                            <div class="text-danger error-text name_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Slug sản phẩm</label>
                            <input type="text" value="{{$category->slug}}" class="form-control" id="convert_slug"
                                   name="slug">
                            <div class="text-danger error-text slug_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Cha danh mục</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0"> None</option>
                                @foreach ($categories as $item)
                                    <option @if ($item->id == $category->parent_id)
                                                selected
                                            @endif value="{{$item->id}}">{{$item->name}}</option>
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
                <button type="button" class="btn btn-primary btn-edit-category" onclick="update_category({{$category->id}})">Sửa</button>
            </div>
        </div>
    </div>
</div>


<script defer>
    $('.close-modal').click(function () {
        $('#modal-edit-category').modal('hide');
    });
    $(document).ready(function () {
        $('.select2').select2();

        $('.tag_multiple').select2({
            theme: "classic",
            tags: true,
        });
    });

    function update_category (id) {
        var page = $(this).attr('data-page');
        $.ajax({
            url: '{{ url('admin/category/update') }}',
            method: 'POST',
            data: {
                name: $('#slug').val(),
                slug: $('#convert_slug').val(),
                parent_id: $('#parent_id').val(),
                id: id,
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
                        $('#modal-edit-category').modal('hide');
                        list_data(data.url)
                        createSuccess(data.message);
                        break;
                    case 2:
                        $('#modal-edit-category').modal('hide');
                        createToast(data.message);
                }
            },
            error: function (error) {
                createToast(error);
            }
        })
    };

</script>
