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
                category: $('#select-category').val(),
                brand: $('#select-brand').val(),
                price: $('#select-price').val(),
                color: $('#select-color').val(),
                size: $('#select-size').val(),
            },
            success: function(data) {
                $('#show-data').fadeOut(400, function() {
                    $(this).html(data);
                    $(this).fadeIn(400);
                });
            },
            error: function(error) {
                createToast('Đã xảy ra lỗi');
            }
        })
    }

    $('#select-sort').on('change', function() {
        var url = $(this).attr('href');
        // window.history.pushState("", "", url);
        paginate(url);
    })
    $('#select-category').on('change', function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        paginate(url);
    })

    $('#select-price').on('change', function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        paginate(url);
    })
    $('#select-color').on('change', function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        paginate(url);
    })

    $('#select-brand').on('change', function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        paginate(url);
    })

    $('#select-size').on('change', function() {
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
