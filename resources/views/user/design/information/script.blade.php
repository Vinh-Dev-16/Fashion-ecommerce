<script>

    $(document).ready(function() {
        $('#show-district').select2(
            {
                placeholder: "Chọn quận/huyện",
                allowClear: true
            }
        );
        $('#show-province').select2(
            {
                placeholder: "Chọn tỉnh/thành phố",
                allowClear: true
            }
        );
        $('#show-commune').select2(
            {
                placeholder: "Chọn xã/phường",
                allowClear: true
            }
        );
        getProvince();
    });

    let district_name = '';
    let province_name = '';
    let commune_name = '';

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    async function getProvince() {
        return await fetch('https://api.mysupership.vn/v1/partner/areas/province')
            .then(res => res.json())
            .then(res => show_data(res))
            .catch(err => console.log(err))
    }

    function show_data(data) {
        $('#show-province').empty();
        $('#show-province').html('<option value="">Chọn tỉnh/thành phố</option>');
        data.results.map((item, index) => {
            $('#show-province').append(`
         <option  value="${item.code}">${item.name}</option>
       `)
        });
    }

    async function province(code) {
        province_name = $('#show-province option:selected').text();
        return await fetch(`https://api.mysupership.vn/v1/partner/areas/district?province=${code}`)
            .then(res => res.json())
            .then(res => show_district(res))
            .catch(err => console.log(err))
    }

    function show_district(data) {
        $('#show-district').empty();
        data.results.map((item, index) => {
            $('#show-district').append(`
          <option value="${item.code}">${item.name}</option>
        `)
        });
    }
    function show_commune(data) {
        $('#show-commune').empty();
        data.results.map((item, index) => {
            $('#show-commune').append(`
          <option value="${item.code}">${item.name}</option>
        `)
        });
    }

    async function district(code) {
        return await fetch(`https://api.mysupership.vn/v1/partner/areas/commune?district=${code}`)
            .then(res => res.json())
            .then(res => show_commune(res))
            .catch(err => console.log(err))
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


    function getShipByAPI() {
    }


    $('#create_address').click(function(){
        $.ajax({
            url : '{{ route('information.do_create') }}',
            type : 'POST',
            data : {
                province : $('#show-province option:selected').text(),
                district : $('#show-district option:selected').text(),
                commune : $('#show-commune option:selected').text(),
                province_id : $('#show-province').val(),
                district_id : $('#show-district').val(),
                commune_id : $('#show-commune').val(),
                address : $('input[name="address"]').val(),
                user_id : '{{ $user->id }}',
            },
            beforeSend: function () {
                $(document).find('div.text-danger').text('');
            },
            success: function(response) {
                switch (response.status) {
                    case 0:
                        $.each(response.message, function (prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                        });
                        break;
                    case 1:
                        createNoti(response.message);
                        setTimeout(function () {
                            window.location.href = '{{ url('information/' . $user->id) }}';
                        }, 1000);
                        break;
                    case 2:
                        createToast(response.message);
                        break;
                }
            },
            error: function (error) {
                createToast(error);
            }

        })
    })

</script>
