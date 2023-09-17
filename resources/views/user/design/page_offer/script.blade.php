<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function wishlist() {
        let user_id = $('#user_id').val();
        let product_id = $('#product_id').val();
        let has_love = $('#has-love').val();
        $.ajax({
            url: "{{ route('page_offer.love') }}",
            method: "POST",
            data: {
                user_id: user_id,
                product_id: product_id,
                love: has_love,
            },
            success: function (data) {
                $('#wish_love').fadeOut(400, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(400);
                });
                $('#wishlist_number').text(data.count);
                if (data.status == 0) {
                    $('#has-love').val(1);
                    createNoti('Đã xóa khỏi danh sách yêu thích');
                } else {
                    $('#has-love').val(0);
                    createNoti('Đã thêm vào danh sách yêu thích');
                }
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }

    const addToCart = document.querySelector('#add_to_cart');

    addToCart.addEventListener('click', (e) => {
        e.preventDefault();
    })
    function add($product_id) {
        var color = $('input[name="color"]:checked').val() ? color = $('input[name="color"]:checked').val() : createToast('Bạn chưa chọn màu');
        var size = $('input[name="size"]:checked').val() ? size = $('input[name="size"]:checked').val() : createToast('Bạn chưa chọn size');
        var stock = $('#stock').val() ? quantity = $('#stock').val() : createToast('Bạn chưa chọn số lượng');
        if (color && size && stock) {
            $.ajax({
                url: "{{ route('cart') }}",
                method: "POST",
                data: {
                    product_id: $product_id,
                    color: color,
                    size: size,
                    quantity: stock,
                },
                success: function (data) {
                    $('#mini_cart').fadeOut(400, function () {
                        $(this).html(data.view);
                        $(this).fadeIn(400);
                    });
                    $('#item_number').text(data.count);
                    $('#card_head').text(data.count);
                    createNoti('Đã thêm vào giỏ hàng');
                    $('#form_cart')[0].reset();
                },
                error: function (data) {
                    createToast('Đã xảy ra lỗi');
                }
            });
        }
    }

    function remove_cart($product_id) {
        $.ajax({
            url: "{{ route('remove_cart') }}",
            method: "POST",
            data: {
                product_id: $product_id,
            },
            success: function (data) {
                $('#mini_cart').fadeOut(400, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(400);
                });
                $('#item_number').text(data.count);
                $('#card_head').text(data.count);
                createNoti('Đã xóa sản phẩm');
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
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

    // slider images

    var productThumb = new Swiper('.small_image', {
        loop: true,
        spaceBetween: 10,
        slidesPerview: 3,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            481: {
                spaceBetween: 32,
            }
        }
    });

    var productBig = new Swiper('.big_image', {
        loop: true,
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: productThumb,
        }
    });

    // Check produtct stock

    function soldOut(element) {
        createToast('Xin lỗi đã hết hàng');
        return false;
    }

    //Phần deal of day
    let countDate = new Date('29,Nov,2023 00:00:00').getTime();
    let day = document.querySelectorAll('.days')
    let minute = document.querySelectorAll('.minutes');
    let hour = document.querySelectorAll('.hours');
    let second = document.querySelectorAll('.seconds');

    function countDown() {
        let now = new Date().getTime();

        gap = countDate - now;

        let seconds = 1000;
        let minutes = seconds * 60;
        let hours = minutes * 60;
        let days = hours * 24;
        let d = Math.floor(gap / (days)) < 10 ? '0' + Math.floor(gap / (days)) : Math.floor(gap / days);
        let h = Math.floor((gap % (days)) / (hours)) < 10 ? '0' + Math.floor((gap % (days)) / (hours)) : Math.floor((
            gap %
            (days)) / (hours));
        let m = Math.floor((gap % (hours)) / (minutes)) < 10 ? '0' + Math.floor((gap % (hours)) / (minutes)) : Math
            .floor((gap % (hours)) / (minutes));
        let s = Math.floor((gap % (minutes)) / (seconds)) < 10 ? '0' + Math.floor((gap % (minutes)) / (seconds)) : Math
            .floor((gap % (minutes)) / (seconds));

        for (const i of day) {
            i.innerHTML = d + " d";
        }
        for (const i of minute) {
            i.innerHTML = m + " m";
        }
        for (const i of hour) {
            i.innerHTML = h + " h";
        }
        for (const i of second) {
            i.innerHTML = s + " s";
        }

    }

    setInterval(() => {
        countDown()
    }, 1000);

    let stocks = document.querySelectorAll('.products .stock');
    for (let i = 0; i < stocks.length; i++) {
        let stock = stocks[i].dataset.stock,
            avaiable = stocks[i].querySelector('.qty_available').innerHTML,
            sold = stocks[i].querySelector('.qty_sold').innerHTML,
            percent = sold * 100 / stock;

        stocks[i].querySelector('.available').style.width = percent + '%';
    }
    ;

    // Check stock
    let quantity = document.querySelector('#stock');
    let minus = document.querySelector('.minus');
    let plus = document.querySelector('.plus');

    minus.addEventListener('click', (e) => {
        let value = parseInt(quantity.value);
        if (value > 1) {
            value -= 1;
            quantity.value = value;
        }
    });

    plus.addEventListener('click', (e) => {
        let value = parseInt(quantity.value);
        if (value < {{ $product->stock }}) {
            value += 1;
            quantity.value = value;
        }

    });

    quantity.addEventListener('change', (e) => {
        if (e.target.value > {{ $product->stock }}) {
            e.target.value = {{ $product->stock }};
            quantity.value = {{ $product->stock }};
        }
    });
</script>

@if (!Auth::check())
    <script>
        review_btn.addEventListener('click', (e) => {
            e.preventDefault();
            createToast('Bạn cần phải đăng nhập');
        })
    </script>
@endif
