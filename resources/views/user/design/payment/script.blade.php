<script>
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
    let total = document.querySelector('.total');
    let voucher = document.querySelector('#voucher_item');

    $(document).ready(function() {
        $('#voucher_item').change(function() {
            let voucher_item = $(this).val();
            $.ajax({
                url: "{{ url('/voucher') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    voucher: voucher_item,
                },
                success: function(data) {
                    showVoucher(data);
                }
            });
        });
    });

    function showVoucher(data) {
        console.log(data)
        let total = document.querySelector('.total');
        let ship = (15000 * data.result.length);
        const calculator = data.result.reduce((total, cartItem) => {
            if (data.result[0].product.discount) {
                return total + cartItem.quantity * (cartItem.product.price - ((cartItem.product
                    .price) * ((cartItem.product.discount) / 100)));
            } else {
                return total + cartItem.quantity * (cartItem.product.price);
            }
        }, 0);
        if (data.result[0].voucher > 100) {
            total.innerText = ((calculator + (calculator * 0.1) + ship) - data.result[0].voucher).toLocaleString(
                'vi-VN') + ' VND';
        } else if (data.result[0].voucher > 0 && data.result[0].voucher <= 100) {
            total.innerText = (Math.floor((calculator + (calculator * 0.1) + ship) - ((calculator + (calculator * 0.1) +
                ship) * (data.result[0].voucher / 100)))).toLocaleString('vi-VN') + ' VND';
        } else {
            total.innerText = (calculator + (calculator * 0.1) + ship).toLocaleString('vi-VN') + ' VND';
        }
    }
</script>