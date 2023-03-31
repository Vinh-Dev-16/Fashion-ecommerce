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


    <div class="container register">
        <form action="{{ url('register') }}" method="POST" class="form">
            @csrf
            <label for="username">Name:</label>
            <input id="name" class="text" name="name" type="text" placeholder="Điền tên..." />
            @error('name')
                <div class="text-danger" style=" color:red">{{ $message }}</div>
            @enderror
            <label for="email">Email:</label>
            <input id="email" class="text" name="email" type="text" placeholder="Điền email..." />
            @error('email')
                <div class="text-danger" style=" color:red">{{ $message }}</div>
            @enderror
            <label for="password">Password:</label>
            <input type="password" name="password"  id="password" placeholder="Password here..." />
            @error('password')
                <div class="text-danger" style=" color:red">{{ $message }}
                </div>
            @enderror
            <label for="password_confirmation">Nhập lại mật khẩu</label>
            <input id="password_confirmation"   placeholder="Nhập lại mật khẩu" name="password_confirmation" type="password">
            @error('password_confirmation')
                <div class="text-danger" style="color:red; margin-bottom:10px;">{{ $message }}
                </div>
            @enderror
            <button name="submit" type="submit">Đăng kí</button>
            <div class="auth">
                <span>Bạn đã có tài khoản?</span><span><a href="{{ url('/login') }}">Đăng nhập</a></span>
            </div>
            <div class="auth" style="margin-top:10px">
                <span><a href="{{ url('/') }}">Về trang chủ</a></span>
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
        <div class="paw-l paw"></div>
        <div class="paw-r paw"></div>
        </div>

        <script>
            let usernameRef = document.querySelector("#name");
            let emailRef = document.querySelector("#email");
            let passwordRef = document.querySelector("#password");
            let password_confirmation = document.querySelector('#password_confirmation');
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
            
            usernameRef.addEventListener("focus", () => {
                focusText();
            });

            emailRef.addEventListener("focus", () => {
              focusText();
            });
            async function focusText(){
                eyeL.style.cssText = `
                        left: 0.75em;
                        top: 1.12em;  
                    `;
                 eyeR.style.cssText = `
                        right: 0.75em;
                        top: 1.12em;
                    `;
                await normalHandStyle();
            }

            //When clicked on password input

            passwordRef.addEventListener("focus", () => {
               focusPasswords();
            });

            password_confirmation.addEventListener("focus", () => {
               focusPasswords();
            });

            function focusPasswords(){
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
            }
            //When clicked outside username and password input
            document.addEventListener("click", (e) => {
                let clickedElem = e.target;
                if (clickedElem != usernameRef && clickedElem != passwordRef && clickedElem != password_confirmation && clickedElem != emailRef) {
                    normalEyeStyle();
                    normalHandStyle();
                }
            });
        </script>
</body>

</html>
