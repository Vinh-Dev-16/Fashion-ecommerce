<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <title>
        Login
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/verify.css') }}" rel="stylesheet" />
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
<ul class="notification">
</ul>
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Đăng nhập</h4>
                                <p class="mb-0">Đăng nhập bằng email và mật khẩu</p>
                            </div>
                            <div class="card-body">
                                <form role="form" action="" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg"
                                               placeholder="Email" aria-label="Email">
                                    </div>
                                    <div class="text-danger error-text email_error"></div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                               placeholder="Password" aria-label="Password">
                                    </div>
                                    <div class="text-danger error-text password_error"></div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember_me"
                                               id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <button class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" onclick="do_login()">Đăng nhập</button>
                                </div>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Bạn chưa có tài khoản?
                                    <a href="{{ url('register') }}"
                                       class="text-primary text-gradient font-weight-bold">Đăng kí</a>
                                </p>

                                <p class="mb-4 text-sm mx-auto">
                                    Quên mật khẩu?
                                    <a href="{{ url('forgotPassword') }}"
                                       class="text-primary text-gradient font-weight-bold">Lấy lại mật khẩu</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                             style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">"Thời trang và hơn thế nữa"</h4>
                            <p class="text-white position-relative">The more effortless the writing looks, the more
                                effort the writer actually put into the process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="show-modal" style="position: absolute !important; top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 10000000;">

        </div>
    </section>
</main>
<!--   Core JS Files   -->

<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>


<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
<script>

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
    };

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    $('input[name="remember_me"]').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).val(1);
        }
    });

    function do_login() {
        $.ajax({
            url: "{{ route('do_login') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
                remember_me: $('input[name="remember_me"]').val(),
            },
            beforeSend: function() {
               $(document).find('div.text-danger').text('');
            },
            success: function(data) {
                switch (data.status) {
                    case 0:
                    $.each(data.message, function(prefix, val) {
                        $('div.' + prefix + '_error').text(val[0]);
                    });
                    break;
                    case 1:
                        createToast(data.message)
                        $('#show-modal').html(data.view);
                        $('#modal-verify').modal('show');
                    break;
                    case 3:
                        createToast(data.message);
                    break;
                }
            },
            error: function(error) {
                createToast('Không thể đăng nhập');
            }
        })
    }
</script>



@if (Session::has('success') || Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {


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
