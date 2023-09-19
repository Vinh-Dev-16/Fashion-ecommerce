<script>

    $(document).ready(function() {

        $(".datepicker").datepicker({
            prevText: '<i class="fa fa-fw fa-angle-left"></i>',
            nextText: '<i class="fa fa-fw fa-angle-right"></i>'
        });
    });


    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
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
</script>
