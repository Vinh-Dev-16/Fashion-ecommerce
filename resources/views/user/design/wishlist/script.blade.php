<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {

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
            },
            success: function(data) {
                $('#show-data').fadeOut(400, function() {
                    $(this).html(data);
                    $(this).fadeIn(400);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function remove_wishlist(id) {
        $.ajax({
            url: "{{ route('wishlist.delete') }}",
            method: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                var url = $(this).attr('href');
                paginate(url);
                createNoti('Đã xóa khỏi danh sách yêu thích');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    const dpt_menu = document.querySelectorAll('.dpt_menu');
    const close_menu = document.querySelectorAll('#close_menu');

    for(let i of dpt_menu){
        i.classList.add('active');
    }
    close_menu.forEach((item)=>{
        item.addEventListener('click', (e) => {
            e.preventDefault();
            for(let i of dpt_menu){
                i.classList.toggle('active');
            }
        });
    })



</script>
