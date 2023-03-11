<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('user/auth.css') }}">
    <title>Register</title>
</head>

<body>

    
    <div class="wrapper_res"
        style=" background-image: linear-gradient(0deg,rgba(0,0,0,.8) 0,transparent 60%,rgba(0,0,0,.8)),
    url('{{ asset('images/banner-bg.png') }}');">
        <div class="main_container">
            <form action="{{ url('register') }}" method="POST" class="form" id="form-1" role="form">
                @csrf
                <h3 class="heading">Đăng ký tài khoản</h3>
                <div class="spacer"></div>
                <div class="form-group">
                    <input id="username" placeholder=" " name="name" type="text" class="form-control"
                        value="">
                    <label for="name" class="form-label">Username</label>
                </div>
                @error('name')
                    <div class="text-danger" style="color: red;">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input id="email" placeholder=" " name="email" type="email" class="form-control"
                        value="">
                    <label for="email" class="form-label">Email</label>
                </div>
                @error('email')
                    <div class="text-danger"
                        style=" color:red">{{ $message }}</div>
                @enderror
                <div class="form-group">
                        <input id="password" placeholder=" " name="password" type="password" class="form-control"
                            value="">
                        <label for="password" class="form-label">Mật khẩu</label>
                    </div>
                    @error('password')
                        <div class="text-danger" style=" color:red">{{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <input id="password_confirmation" placeholder=" " name="password_confirmation" type="password"
                            class="form-control" value="">
                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                    </div>
                    @error('password_confirmation')
                        <div class="text-danger" style="color:red; margin-bottom:10px;">{{ $message }}
                        </div>
                    @enderror
                    <button id="button" class="form-submit" name="submit" type="submit">Đăng ký</button>
                    <div class="sign-in">
                        Bạn đã có tài khoản?
                        <a href="{{route('login')}}">Đăng nhập</a>
                    </div>
                </form>

            </div>
        </div>

        @include('sweetalert::alert')

    </body>

    </html>
