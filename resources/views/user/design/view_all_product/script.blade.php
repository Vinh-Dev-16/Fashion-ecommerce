<script>

    $(function () {
        $('#select-price').select2({
            placeholder: "Chọn giá sản phẩm",
            allowClear: true
        });
        $('#select-color').select2({
            placeholder: "Chọn màu sản phẩm",
            allowClear: true
        });
        $('#select-sort').select2({
            placeholder: "Sắp xếp sản phẩm",
            allowClear: true
        });
        $('#select-brand').select2({
            placeholder: "Chọn thương hiệu sản phẩm",
            allowClear: true
        });
        $('#select-category').select2({
            placeholder: "Chọn danh mục sản phẩm",
            allowClear: true
        });
        $('#select-size').select2({
            placeholder: "Chọn size sản phẩm",
            allowClear: true
        });
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.history.pushState("", "", url);
            paginate(url);
        });
    });


    function paginate(url) {
        $.ajax({
            url: url,
            method: "GET",
            data: {
                _token: "{{ csrf_token() }}",
                sort: $('#select-sort').val(),
            },
            success: function(data) {
                $('#show-data').html(data);
            },
            error: function(error) {
                createToast('Đã xảy ra lỗi');
            }
        })
    }

    $('#select-sort').on('change', function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        paginate(url);
    })


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
