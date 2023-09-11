<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <title>
        Register
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/verify.css') }}" rel="stylesheet"/>
</head>

<body class="">
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
<ul class="notification">
</ul>
<!-- Navbar -->
<nav
    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{route('admin.dashboard.index')}}">
            <img src="{{ asset('images/logoCart.png') }}" alt="Fashion Logo"
                 class="navbar-brand-img h-100" style="opacity: .8; width: 40px">
            Fashion
        </a>
    </div>
</nav>
<!-- End Navbar -->
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
         style="background-image: url('https://pkmacbook.com/wp-content/uploads/2021/07/banner-thoi-trang-dang-cap-hien-dai_113856116.png'); background-position: center;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Đăng kí</h1>
                    <p class="text-lead text-white">Đăg kí để hưởng ưu đãi từ chúng tôi. Fashion is life</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Đăng kí</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Tên đăng nhập"
                                       name="name" aria-label="Name">
                            </div>
                            <div class="text-danger error-text name_error" style="color:red; margin-bottom:10px;">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email của bạn"
                                       name="email" aria-label="Email">
                            </div>
                            <div class="text-danger error-text email_error" style=" color:red"></div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Nhập password"
                                       name="password" aria-label="Password">
                            </div>
                            <div class="text-danger error-text password_error" style=" color:red"></div>
                        </form>
                        <div class="text-center">
                            <button type="submit" id="btn-register" class="btn bg-gradient-dark w-100 my-4 mb-2">Đăng
                                kí
                            </button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Bạn đã có tài khoản? <a href="{{ url('/login') }}"
                                                                             class="text-dark font-weight-bolder">Đăng
                                nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="show-modal"
             style="display: none; position: absolute !important; top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 10000000; background-color: rgba(0, 0, 0, 0.5); width: 100%;height: 100%;">

        </div>
    </div>
</main>
<!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-dribbble"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-twitter"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-instagram"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-pinterest"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-github"></span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    Xuan Vinh.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
<!--   Core JS Files   -->

<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const notifications = document.querySelector('.notification');
    const toast = document.querySelector('.toasts');
    const timer = 3000;

    const removeSuccess = (message) => {
        message.classList.add("hide");
        if (message.timeoutId) clearTimeout(message.timeoutId);
        setTimeout(() => message.remove(), 400);
    };


    // Tao Toast

    function createSuccess(message) {
        const noti = document.createElement('li');
        noti.className = `toasts success`;
        noti.innerHTML = `
                        <div class="column">
                         <i class="fa fa-check"></i>
                            <span>${message}</span>
                        </div>
                           <i class="fa fa-xmark"></i>
                        `
        notifications.appendChild(noti);
        setTimeout(() => removeSuccess(message), 3000)
    };

    // Tao remove toast

    const removeToast = (toast) => {
        toast.classList.add("hide");
        if (toast.timeoutId) clearTimeout(toast.timeoutId);
        setTimeout(() => toast.remove(), 400);
    };


    // Tao Toast

    function createToast(toastMessage) {
        const toast = document.createElement('li');
        toast.className = `toasts error`;
        toast.innerHTML = `
                <div class="column">
                   <i class="ri-bug-line"></i>
                    <span>${toastMessage}</span>
                </div>
                  <i class="fa fa-xmark"></i>
                `
        notifications.appendChild(toast);
        setTimeout(() => removeToast(toast), 3000)
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    $('#btn-register').click(function (e) {
        e.preventDefault();
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('do_register') }}",
            data: {
                name: name,
                email: email,
                password: password,
            },
            beforeSend: function () {
                $(document).find('div.text-danger').text('');
            },
            success: function (data) {
                switch (data.status) {
                    case 0:
                        $.each(data.message, function (prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                        });
                        break;

                    case 1:
                        createToast(data.message);
                        break;
                    case 2:
                        createSuccess(data.message);
                        setTimeout(() => {
                            window.location.href = '{{ route('login') }}';
                        }, 2000);
                        break;
                }
            },
            error: function (error) {
                createToast('Không thể đăng nhập');
            }
        })
    })

</script>
@if (Session::has('success') || Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function removeToast(toast) {
                toast.classList.add("hide");
                if (toast.timeoutId) clearTimeout(toast.timeoutId);
                setTimeout(() => toast.remove(), 400);
            }

            setTime();

            function setTime() {
                setTimeout(() => removeToast(toast), 3000)
            }
        });
    </script>
@endif
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
