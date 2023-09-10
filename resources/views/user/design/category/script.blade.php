<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    document.addEventListener('DOMContentLoaded', () => {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        list_data(url);
    })
    $('body').on('click', '.pagination a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        list_data(url);
    });
    const FtoShow = '.filter';
    const Fpopup = document.querySelector(FtoShow);
    const Ftrigger = document.querySelector('.filter_trigger');
    Ftrigger.addEventListener('click',(e)=>{
        e.preventDefault();
        setTimeout(() => {
            if(!Fpopup.classList.contains('show')){
                Fpopup.classList.add('show');
            }
        }, 250);
    })
    document.addEventListener('click', (e)=>{
        const isClosest = e.target.closest(FtoShow);
        if(!isClosest && Fpopup.classList.contains('show')){
            Fpopup.classList.remove('show');
        }
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

    $('input[name="brand[]"]').change(function() {
        list_data();
    })

    $('.select-color').change(function() {
        list_data();
    })
    $('#cancel-filter').click(function() {
        $('#cancel-filter').val('1');
        $('input[name="color"]').prop('checked', false);
        $('input[name="brand[]"]').prop('checked', false);
        list_data();
    })
    $('#select-filter').change(function() {
        var url = $(this).attr('href');
        window.history.pushState("", "", url);
        list_data(url);
    })

    async function list_data(url) {
        let selectedValues = [];
        $('input[name="brand[]"]:checked').each(function() {
            selectedValues.push($(this).val());
        });
        $.ajax({
            url: url,
            method: "GET",
            data: {
                slug: $('#slug').val(),
                color: $('input[name="color"]:checked').val(),
                brand: selectedValues,
                cancel: $('#cancel-filter').val(),
                select_filter: $('#select-filter').val(),
            },
            success: function(data) {
                $('#show-data').fadeOut(400, function() {
                    $(this).html(data);
                    $(this).fadeIn(400);
                });
                $('#cancel-filter').val('');
            },
            error: function(error) {
                unblock_screen();
                createToast('Không thể lấy dữ liệu');
            }
        })
    }

    function love(product_id) {
        $.ajax({
            url: "{{ route('category.love') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                user_id: $('#user_id').val(),
            },
            success: function(data) {
                if (data.status == 0) {
                    createToast(data.message);
                }else {
                    createNoti(data.message);
                    $('#wishlist_number').text(data.count);
                    list_data();
                }

            },
            error: function(error) {
                createToast('Không thể thêm vào danh sách yêu thích');
            }
        })
    }

</script>
