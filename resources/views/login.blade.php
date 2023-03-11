<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('user/auth.css') }}">
    <title>Login</title>
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
    @endif
    @if (Session::has('warning'))
        <div class="flash_message">
            <ul class="notification">
                <li>
                    <div class="column">
                        <i class="fa fa-check"></i>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <i class="fa fa-xmark"></i>
                </li>
            </ul>
        </div>
    @endif
    <div class="wrapper_res"
        style=" background-image: linear-gradient(0deg,rgba(0,0,0,.8) 0,transparent 60%,rgba(0,0,0,.8)),
    url('{{ asset('images/banner-bg.png') }}');">
        <div class="main_container main_login" style="height: 400px;">
            <form action="{{ url('login') }}" method="POST" class="form" id="form-1" role="form">
                @csrf
                <h3 class="heading">Đăng ký tài khoản</h3>
                <div class="spacer"></div>
                <div class="form-group">
                    <input id="email" placeholder=" " name="email" type="email" class="form-control"
                        value="">
                    <label for="email" class="form-label">Email</label>
                </div>
                {{-- @error('email')
                    <div class="text-danger"
                        style=" color:red">{{ $message }}</div>
                @enderror --}}
                <div class="form-group">
                    <input id="password" placeholder=" " name="password" type="password" class="form-control"
                        value="">
                    <label for="password" class="form-label">Mật khẩu</label>
                </div>
                {{-- @error('password')
                        <div class="text-danger" style=" color:red">{{ $message }}
                        </div>
                    @enderror --}}
                <button id="button" class="form-submit" name="submit" type="submit">Đăng ký</button>
                <div class="sign-in">
                    Bạn chưa có tài khoản?
                    <a href="{{ route('register') }}">Đăng kí</a>
                </div>
            </form>

        </div>
    </div>


</body>

</html>
