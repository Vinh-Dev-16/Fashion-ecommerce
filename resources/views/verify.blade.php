<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/verify.css')}}">
    <title>Verify Email</title>
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
                <i class="fa fa-xmark"></i>
                <span>{{ session('error') }}</span>
            </div>
            <i class="fa fa-xmark"></i>
        </li>
    </ul>
@endif
<!-- Further code here -->
<div class="overlay"></div>
<div class="container">
    <p>Mã đã gửi đến  {{$user->email}}</p>
    <h1>Enter OTP</h1>
    <form method="post" id="verificationForm">
        @csrf
        <input id="email" value="{{$user->email}}" name="email" type="email" hidden="hidden">
        <div class="otp-field">
            <input type="text" name="otp" maxlength="1" />
            <input type="text" name="otp" maxlength="1" />
            <input type="text" name="otp" maxlength="1" />
            <input type="text" name="otp" maxlength="1" />
            <input type="text" name="otp" maxlength="1" />
            <input type="text" name="otp" maxlength="1" />
        </div>
    </form>
    <p class="time"></p>

    <a class="otpHref" href="{{url('resend-otp/' . $user->email)}}" >Gửi lại mã OTP</a>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

    function timer()
    {
        let seconds = 30;
        let minutes = 1;

        let timer = setInterval(() => {

            if(minutes < 0){
                $('.time').text('');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

                $('.time').text(tempMinutes+':'+tempSeconds);
            }

            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }

            seconds--;

        }, 1000);
    }

    timer();

    const inputs = document.querySelectorAll(".otp-field input");
    inputs.forEach((input, index) => {
        input.dataset.index = index;
        input.addEventListener("keyup", handleOtp);
        input.addEventListener("paste", handleOnPasteOtp);
    });
    function handleOtp(e) {

        const input = e.target;
        let value = input.value;
        let isValidInput = value.match(/[0-9a-z]/gi);
        input.value = "";
        input.value = isValidInput ? value[0] : "";
        let fieldIndex = input.dataset.index;
        if (fieldIndex < inputs.length - 1 && isValidInput) {
            input.nextElementSibling.focus();
        }
        if (e.key === "Backspace" && fieldIndex > 0) {
            input.previousElementSibling.focus();
        }
        if (fieldIndex == inputs.length - 1 && isValidInput) {
            submit();
        }
    }
    function handleOnPasteOtp(e) {
        const data = e.clipboardData.getData("text");
        const value = data.split("");
        if (value.length === inputs.length) {
            inputs.forEach((input, index) => (input.value = value[index]));
            submit();
        }
    }
    function submit() {
        let otp = "";
        inputs.forEach((input) => {
            otp += input.value;
            input.disabled = true;
            input.classList.add("disabled");
        });
        console.log(otp);
        let verificationForm = document.getElementById('verificationForm');
        verificationForm.addEventListener('submit', (e)=>{
            e.preventDefault();
        })
        let email = document.getElementById('email').value;

        sendOTP(otp, email);
    }
    async function sendOTP(otp, email) {
        let data = {
            email: email,
            otp: otp,
        }
        const res = await fetch(`{{route('verify')}}`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(response =>response.json())
                .then(data => {
                    if (data.success == true) {
                        if (data.role == 'user') {
                            window.location.href = {{route('/')}};
                        } else {
                            window.location.href = {{route('admin.dashboard')}}
                        }
                    } else {
                        window.location.href = {{route('login')}};
                    }

                }).catch(error => {
                    console.log(error);
                })
        ;
    }

</script>
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
</body>
</html>
