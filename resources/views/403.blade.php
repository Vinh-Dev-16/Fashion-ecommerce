<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/404.css') }}">
    <title>Page 403</title>
</head>

<body>
@if (Session::has('success'))
    <ul class="notification">
        <li class="success toasts">
            <div class="column">
                <i class="fa fa-check"></i>
                <span>{{ session('success') }}</span>
            </div>
            <i class="fa fa-xmark"></i>
        </li>
    </ul>
@elseif (Session::has('error'))
    <ul class="notification">
        <li class="error toasts">
            <div class="column">
                <i class="ri-bug-line"></i>
                <span>{{ session('error') }}</span>
            </div>
            <i class="fa fa-xmark"></i>
        </li>
    </ul>
@endif
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
            <span>3</span>
        </div>
    </div>
    <div class="text">
        <h3>OPP.s</h3>
        <p>Không có quyền truy cập</p>
        <button id="reload">Load lại trang</button>

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
