<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
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
                $('#wish_love').fadeOut(300, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(300);
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
    });
    function add_cart($product_id) {
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
                    $('#mini_cart').fadeOut(300, function () {
                        $(this).html(data.view);
                        $(this).fadeIn(300);
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
                $('#mini_cart').fadeOut(200, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(200);
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

    // feedback

    function send_feed_back(product_id)
    {
        let rate = $('input[name="rate"]:checked').val();
        let title = $('input[name="title"]').val();
        let content = $('textarea[name="content"]').val();
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        $.ajax({
            url: "{{ route('detail.feedback.store') }}",
            method: "POST",
            data: {
                product_id: product_id,
                rate: rate,
                title: title,
                content: content,
                name: name,
                email: email,
            },

            success: function (data) {
                switch (data.status) {
                    case 0:
                        createToast('Bạn cần phải đăng nhập');
                        break;
                    case 1:
                        createToast('Bạn đã đánh giá sản phẩm này');
                        break;
                    case 2:
                        $('#review_form').fadeOut(300, function () {
                            $(this).html(data.view);
                            $(this).fadeIn(300);
                        });
                        createNoti('Đã gửi đánh giá');
                        break;
                }
                $('#review_form').fadeOut(300, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(300);
                });
                createNoti('Đã gửi đánh giá');
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

    // Check produtct stock

    function soldOut(element) {
        createToast('Xin lỗi đã hết hàng');
        return false;
    }

    // slider images

    var productThumb = new Swiper('.small_image', {

        breakpoints: {
            481: {
                spaceBetween: 32,
            }
        },
        navigation: {
            nextEl: '.swiper-button-next-small',
            prevEl: '.swiper-button-prev-small',
        },
    });

    var productBig = new Swiper('.big_image', {
        loop: true,
        spaceBetween: 10,
        centeredSlides: true,
        autoplay: {
            delay: 5500,
            disableOnInteraction: false,
        },
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: productThumb,
        }
    });


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
