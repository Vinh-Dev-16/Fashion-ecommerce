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


    function confirmation(eve) {
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
                    window.location.href = url;
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



</script>
