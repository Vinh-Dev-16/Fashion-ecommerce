<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('user/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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
    @if (Session::has('error'))
        <ul class="notification">
            <li class="error toasts">
                <div class="column">
                    <i class="fa-solid fa-x"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <i class="fa fa-xmark"></i>
            </li>
        </ul>
    @endif


    <div class="container">
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input id="text" name="email" type="email" placeholder="Điền email..." />
            @error('email')
                <div class="text-danger" style=" color:red">{{ $message }}</div>
            @enderror
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Điền password..." />
            @error('password')
            <div class="text-danger" style=" color:red">{{ $message }}
            </div>
        @enderror
            <button name="submit" type="submit">Đăng nhập</button>
            <hr>
            <br>
            <a href="{{ url('/auth/redirect/facebook') }}"> Đăng nhập bằng Facebook</a>
            <div class="auth">
                <span>Bạn chưa có tài khoản?</span><span><a href="{{url('/register')}}">Đăng kí</a></span>
            </div>
            <div class="auth" style="margin-top:10px">
                <span><a href="{{url('/')}}">Về trang chủ</a></span>
            </div>
        </form>

        <div class="ear-l"></div>
        <div class="ear-r"></div>
        <div class="panda-face">
            <div class="blush-l"></div>
            <div class="blush-r"></div>
            <div class="eye-l">
                <div class="eyeball-l"></div>
            </div>
            <div class="eye-r">
                <div class="eyeball-r"></div>
            </div>
            <div class="nose"></div>
            <div class="mouth"></div>
        </div>
        <div class="hand-l"></div>
        <div class="hand-r"></div>
        <div class="paw-l"></div>
        <div class="paw-r"></div>
    </div>

    @if (Session::has('success') || Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const notifications = document.querySelector('.notification');
                const toast = document.querySelector('.toasts');
                const timer = 3000;


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


    <script>
        let text= document.getElementById("text");
        let passwordRef = document.getElementById("password");
        let eyeL = document.querySelector(".eyeball-l");
        let eyeR = document.querySelector(".eyeball-r");
        let handL = document.querySelector(".hand-l");
        let handR = document.querySelector(".hand-r");

        let normalEyeStyle = () => {
            eyeL.style.cssText = `
    left:0.6em;
    top: 0.6em;
  `;
            eyeR.style.cssText = `
  right:0.6em;
  top:0.6em;
  `;
        };

        let normalHandStyle = () => {
            handL.style.cssText = `
        height: 2.81em;
        top:8.4em;
        left:7.5em;
        transform: rotate(0deg);
    `;
            handR.style.cssText = `
        height: 2.81em;
        top: 8.4em;
        right: 7.5em;
        transform: rotate(0deg)
    `;
        };
        //When clicked on username input
        text.addEventListener("focus", () => {
            eyeL.style.cssText = `
    left: 0.75em;
    top: 1.12em;  
  `;
            eyeR.style.cssText = `
    right: 0.75em;
    top: 1.12em;
  `;
            normalHandStyle();
        });
        //When clicked on password input
        passwordRef.addEventListener("focus", () => {
            handL.style.cssText = `
        height: 6.56em;
        top: 3.87em;
        left: 11.75em;
        transform: rotate(-155deg);    
    `;
            handR.style.cssText = `
    height: 6.56em;
    top: 3.87em;
    right: 11.75em;
    transform: rotate(155deg);
  `;
            normalEyeStyle();
        });
        //When clicked outside username and password input
        document.addEventListener("click", (e) => {
            let clickedElem = e.target;
            if (clickedElem != text && clickedElem != passwordRef) {
                normalEyeStyle();
                normalHandStyle();
            }
        });
    </script>
</body>

</html>
