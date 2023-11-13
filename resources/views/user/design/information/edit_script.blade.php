<script>
    $(document).ready(function () {
        var old_province = {{ $user->information->province_id }} > 10 ? {{ $user->information->province_id }} : '0' + {{ $user->information->province_id }};
        var old_district = {{ $user->information->district_id }};
        if (old_district < 10) {
            old_district = '0' + old_district;
        } else if (old_district < 100) {
            old_district = '00' + old_district;
        }
        var old_commune = {{ $user->information->commune_id }};
        edit_district(old_province , old_district);
        edit_province(old_province);
        edit_commune(old_commune, old_district);
    });


    function edit_province(old_province) {
        return fetch('https://api.mysupership.vn/v1/partner/areas/province')
            .then(res => res.json())
            .then(res => show_edit_province(res, old_province))
            .catch(err => console.log(err))
    }

    function show_edit_province(data, old_province) {
        $('#show-province').empty();
        $('#show-province').html('<option value="">Chọn tỉnh/thành phố</option>');
        data.results.map((item, index) => {
            if (item.code == old_province) {
                $('#show-province').append(`
             <option selected value="${item.code}">${item.name}</option>
           `)
            } else {
                $('#show-province').append(`
             <option  value="${item.code}">${item.name}</option>
           `)
            }
        });
    }

    function edit_district( old_province, old_district) {
        return fetch(`https://api.mysupership.vn/v1/partner/areas/district?province=${old_province}`)
            .then(res => res.json())
            .then(res => show_edit_district(res, old_district))
            .catch(err => console.log(err))
    }

    function show_edit_district(data, old_district) {
        $('#show-district').empty();
        data.results.map((item, index) => {
            if (item.code == old_district) {
                $('#show-district').append(`
              <option selected value="${item.code}">${item.name}</option>
            `)
            } else {
                $('#show-district').append(`
              <option value="${item.code}">${item.name}</option>
            `)
            }
        });
    }

    function edit_commune(old_commune, old_district) {
        return fetch(`https://api.mysupership.vn/v1/partner/areas/commune?district=${old_district}`)
            .then(res => res.json())
            .then(res => show_edit_commune(res, old_commune))
            .catch(err => console.log(err))
    }

    function show_edit_commune(res, old_commune) {
        $('#show-commune').empty();
        res.results.map((item, index) => {
            if (item.code == old_commune) {
                $('#show-commune').append(`
              <option selected value="${item.code}">${item.name}</option>
            `)
            } else {
                $('#show-commune').append(`
              <option value="${item.code}">${item.name}</option>
            `)
            }
        });
    }


    $('#edit_address').click(function(){
        $.ajax({
            url : '{{ route('information.update_create') }}',
            type : 'POST',
            data : {
                province_id : $('#show-province').val(),
                district_id : $('#show-district').val(),
                commune_id : $('#show-commune').val(),
                province : $('#show-province option:selected').text(),
                district : $('#show-district option:selected').text(),
                commune : $('#show-commune option:selected').text(),
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
