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
    $('#search-value').keyup(function (e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        console.log(url);
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-value').val(),
            },
            success: function (data) {
                $('#show-data').html(data);

            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $('.create-value').click(function () {
        get_modal_value();
    });

    function get_modal_value() {
        $.ajax({
            url: '{{ route('admin.value.create') }}',
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-create-value').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function confirmation(eve, id) {
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
                        url: '{{ url('admin/value/destroy')}}',
                        method: 'DELETE',
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

   function get_modal_edit_value(id) {
        $.ajax({
            url: '{{ url('admin/value/edit') }}/' + id,
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-edit-value').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }



</script>
