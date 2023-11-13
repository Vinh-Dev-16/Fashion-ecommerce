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

    $('#search-attribute').keyup(function(e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-attribute').val(),
            },
            success: function (data) {
                $('#show-data').fadeOut(200, function() {
                    $(this).html(data);
                    $(this).fadeIn(200);
                });

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
                        url: '{{ route('admin.attribute.destroy')}}',
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

    $('.create-attribute').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('admin.attribute.create') }}',
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-create-attribute').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    });


</script>
