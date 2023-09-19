
<script>
    if (window.sessionStorage.getItem('close')) {
        window.onload = function () {
            document.querySelector('.site').classList.remove('showmodal')
        };
    } else {
        window.onload = function () {
            document.querySelector('.site').classList.toggle('showmodal')
        };
    }
    document.querySelector('.modalclose').addEventListener('click', function () {
        document.querySelector('.site').classList.remove('showmodal')
    });


    document.querySelector('.again').addEventListener('click', function (e) {
        e.preventDefault();
        window.sessionStorage.setItem('close', 'showmodal');
        document.querySelector('.site').classList.remove('showmodal');
    });
    //Phần deal of day
    let countDate = new Date('29,October,2023 00:00:00').getTime();

    function countDown() {
        let now = new Date().getTime();

        gap = countDate - now;

        let seconds = 1000;
        let minutes = seconds * 60;
        let hours = minutes * 60;
        let day = hours * 24;
        let d = Math.floor(gap / (day)) < 10 ? '0' + Math.floor(gap / (day)) : Math.floor(gap / day);
        let h = Math.floor((gap % (day)) / (hours)) < 10 ? '0' + Math.floor((gap % (day)) / (hours)) : Math.floor((gap %
            (day)) / (hours));
        let m = Math.floor((gap % (hours)) / (minutes)) < 10 ? '0' + Math.floor((gap % (hours)) / (minutes)) : Math
            .floor((gap % (hours)) / (minutes));
        let s = Math.floor((gap % (minutes)) / (seconds)) < 10 ? '0' + Math.floor((gap % (minutes)) / (seconds)) : Math
            .floor((gap % (minutes)) / (seconds));

        document.querySelector('.days').innerText = d;
        document.querySelector('.hours').innerText = h;
        document.querySelector('.minutes').innerText = m;
        document.querySelector('.seconds').innerText = s;


    }

    setInterval(() => {
        countDown()
    }, 1000);
</script>
