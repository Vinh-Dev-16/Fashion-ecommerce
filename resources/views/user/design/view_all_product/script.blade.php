<script>

    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.history.pushState("", "", url);
            list_data(url);
        });
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: "GET",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                $('#show-data').html(data);
            },
            error: function(error) {
                createToast('Đã xảy ra lỗi');
            }
        })
    }
    const dpt_menu = document.querySelectorAll('.dpt_menu');
    const close_menu = document.querySelectorAll('#close_menu');

    for (let i of dpt_menu) {
        i.classList.add('active');
    }
    close_menu.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            for (let i of dpt_menu) {
                i.classList.toggle('active');
            }
        });
    })


</script>
