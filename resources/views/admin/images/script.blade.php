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
    $('#search-image').keyup(function (e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-image').val(),
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
</script>
