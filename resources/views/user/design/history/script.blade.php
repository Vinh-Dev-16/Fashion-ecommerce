<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

    const tabs = document.querySelectorAll(".tabs li");
    const content = document.querySelectorAll(".content_tabs");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) => tab.classList.remove("active"));

            tab.classList.add("active");
            content.forEach(c => c.classList.remove("active"));
            content[index].classList.add('active');
        });
    });
    tabs[0].click();

    let detail_ship = document.querySelectorAll('.detail_ship');
    let main_ship = document.querySelectorAll('.main_ship');

    detail_ship.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            main_ship.forEach(c => c.classList.remove("active"));
            main_ship[index].classList.toggle('active');
        });
    });

    let history_ship = document.querySelectorAll('.history_ship');
    let history = document.querySelectorAll('.history');

    history_ship.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            main_ship.forEach(c => c.classList.remove("active"));
            history[index].classList.toggle('active');
        });
    });

    function print_invoice(e, id) {
        $.ajax({
            url: "{{ route('history.print') }}",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $('.show-data').html(data);
                $('.modal-data').addClass('active');
            },
            error: function(jqXHR, textStatus, errorThrown) {
               createToast('Đã xảy ra lỗi');
            }
        })
    }

    $('#create_feedback').on('click', function(e) {
        let product_id  = $(this).data('id');
    })

</script>
