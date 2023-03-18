<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/404.css') }}">
    <title>Page 404</title>
</head>

<body>
    <div class="wrapper">
        <div class="animation">
            <div class="ani_crane">
                <img class="crane" src="{{asset('images/crane.png')}}" alt="crane">
            </div>
            <div class="flex">
                <span>
                    4
                    <img class="bird" src="{{asset('images/bird.png')}}" alt="bird">
                </span>
                <span>
                    <img class="plaint" src="{{asset('images/plaint.png')}}" alt="plaint">
                    <small class="dot_1"></small>
                    <small class="dot_2"></small>
                    <small class="dot_3"></small>
                </span>
                <span>4</span>
            </div>
        </div>
        <div class="text">
            <h3>OPP.s</h3>
            <p>Page not found</p>
            <button id="reload">Reload</button>

        </div>
    </div>
    <script>
        const btn = document.querySelector('#reload');
        console.log(btn);

        btn.addEventListener("click", function() {
            location.reload();

        });
    </script>
</body>

</html>
