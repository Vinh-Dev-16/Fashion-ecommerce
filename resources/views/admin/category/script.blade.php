<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            list_data(url);
        });
    });

    $('#search-category').keyup(function(e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-category').val(),
            },
            success: function (data) {
                // $('#show-data').fadeOut(200, function() {
                //     $(this).html(data);
                //     $(this).fadeIn(200);
                // });
                $('#show-data').html(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function confirmation(eve, id) {
        let url = eve.getAttribute('href');
        console.log(url);
        swal({
            title: 'Bạn có chắc là xóa nó chứ?',
            text: 'Bạn không thể restore nó',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willCancle) => {
                if (willCancle) {
                    $.ajax({
                        url: '{{ url('admin/category/destroy')}}',
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            switch (data.status) {
                                case 0:
                                    createToast(data.message);
                                    break;
                                case 1:
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
                    });
                }
            })
        return false;
    }

    $('.create-category').click(function () {
        get_modal_category();
    });

    function get_modal_category() {
        $.ajax({
            url: '{{ route('admin.category.create') }}',
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-create-category').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function get_modal_edit_category(id) {
        $.ajax({
            url: '{{ url('admin/category/edit') }}/' + id,
            method: 'GET',
            data: {
                id: id,
            },
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-edit-category').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>
