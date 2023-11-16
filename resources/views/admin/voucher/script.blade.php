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

    $('#search-voucher').keyup(function (e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-voucher').val(),
            },
            success: function (data) {
                $('#show-data').fadeOut(200, function () {
                    $(this).html(data);
                    $(this).fadeIn(200);
                });

            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $('.create-voucher').click(function () {
        $.ajax({
            url: '{{ url('admin/voucher/create')}}',
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-create-voucher').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    function get_modal_edit_voucher(id) {
        $.ajax({
            url: '{{ url('admin/voucher/edit')}}/' + id,
            method: 'GET',
            success: function (data) {
                $('#show-modal').html(data);
                $('#modal-edit-voucher').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>
