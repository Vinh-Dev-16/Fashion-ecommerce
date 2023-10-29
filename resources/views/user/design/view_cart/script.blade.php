<script>
    const dpt_menu = document.querySelectorAll('.dpt_menu');
    const close_menu = document.querySelectorAll('#close_menu');
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon");
    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

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

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const checkAllBtn = document.getElementById('checkBoxAll');


    checkAllBtn.addEventListener('click', function (e) {
        e.preventDefault();
        checkboxes.forEach((checkbox) => {
            checkbox.checked = true;
        });
    });

    $(document).on('click', 'input[name="ids[]"]', function () {
        let id = $(this).attr('data-id');
        let url = '{{ route('selectedCart') }}';
        let data = {
            id: id,
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                $('#show-data').fadeOut(400, function () {
                    $(this).html(response.view);
                    $(this).fadeIn(400);
                    $('#mini_cart').fadeOut(400, function () {
                        $(this).html(response.html);
                        $(this).fadeIn(400);
                    });
                    $('#item_number').text(response.count);
                });
            },
            error: function (response) {
                createToast('Có lỗi xảy ra, vui lòng thử lại sau');
            }
        });
    });

    // quantity

    function decrement(id, el) {
        let quantity = el.parentElement.querySelector('#quantity_cart');
        let value = parseInt(quantity.value);
        if (value > 1) {
            value -= 1;
            quantity.value = value;
            updateQuantity(id, value, el);
        } else {
            createToast('Số lượng phải lớn hơn 0');
        }
    }

    function increment(id, stock, el) {
        let quantity = el.parentElement.querySelector('#quantity_cart');
        let value = parseInt(quantity.value);
        if (value < stock) {
            value += 1;
            quantity.value = value;
        }else{
            createToast('Đã hết hàng');
        }
        updateQuantity(id, value, el);
    }

    function updateQuantity(id, quantity, el) {
        let url = '{{ route('update_quantity') }}';
        let data = {
            id: id,
            quantity: quantity,
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                $('#show-data').fadeOut(400, function () {
                    $(this).html(response.view);
                    $(this).fadeIn(400);
                    $('#mini_cart').fadeOut(400, function () {
                        $(this).html(response.html);
                        $(this).fadeIn(400);
                    });
                    $('#item_number').text(response.count);
                });
            },
            error: function (response) {
                createToast('Có lỗi xảy ra, vui lòng thử lại sau');
            }
        });
    }

    function remove_cart_view(id) {
        let url = '{{ route('delete_cart') }}';
        let data = {
            id: id,
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                $('#show-data').fadeOut(300, function () {
                    $(this).html(response.view);
                    $(this).fadeIn(300);
                });
                $('#mini_cart').fadeOut(300, function () {
                    $(this).html(response.html);
                    $(this).fadeIn(300);
                });
                $('#item_number').text(response.count);
                $('#card_head').text(response.count);
                createNoti('Đã xóa khỏi giỏ hàng');
            },
            error: function (response) {
                createToast('Có lỗi xảy ra, vui lòng thử lại sau');
            }
        });
    }

</script>
