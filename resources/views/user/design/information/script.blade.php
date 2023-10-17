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
</script>
