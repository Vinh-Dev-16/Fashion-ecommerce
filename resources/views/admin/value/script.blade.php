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
</script>
