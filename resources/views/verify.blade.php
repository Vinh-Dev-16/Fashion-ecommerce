
<div class="wrapper-verify hide" id="modal-verify">
    <div class="overlay"></div>
    <div class="container-verify">
        <p>Mã đã gửi đến {{$user->email}}</p>
        <h1>Enter OTP</h1>
        <form method="post" id="verificationForm">
            @csrf
            <input id="email" value="{{$user->email}}" name="email" type="email" hidden="hidden">
            <div class="otp-field">
                <input type="text" name="otp" maxlength="1"/>
                <input type="text" name="otp" maxlength="1"/>
                <input type="text" name="otp" maxlength="1"/>
                <input type="text" name="otp" maxlength="1"/>
                <input type="text" name="otp" maxlength="1"/>
                <input type="text" name="otp" maxlength="1"/>
            </div>
        </form>
        <p class="time"></p>

        <a class="otpHref" href="">Gửi lại mã OTP</a>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

    function timer() {
        let seconds = 30;
        let minutes = 1;

        let timer = setInterval(() => {

            if (minutes < 0) {
                $('.time').text('');
                clearInterval(timer);
            } else {
                let tempMinutes = minutes.toString().length > 1 ? minutes : '0' + minutes;
                let tempSeconds = seconds.toString().length > 1 ? seconds : '0' + seconds;

                $('.time').text(tempMinutes + ':' + tempSeconds);
            }

            if (seconds <= 0) {
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
        verificationForm.addEventListener('submit', (e) => {
            e.preventDefault();
        })
        let email = document.getElementById('email').value;

        // sendOTP(otp, email);
    }

    {{--async function sendOTP(otp, email) {--}}
    {{--    let data = {--}}
    {{--        email: email,--}}
    {{--        otp: otp,--}}
    {{--    }--}}
    {{--    const res = await fetch(`{{route('verify')}}`, {--}}
    {{--            method: 'POST',--}}
    {{--            headers: {--}}
    {{--                'Content-Type': 'application/json'--}}
    {{--            },--}}
    {{--            body: JSON.stringify(data),--}}
    {{--        }).then(response => response.json())--}}
    {{--            .then(data => {--}}
    {{--                if (data.success == true) {--}}
    {{--                    if (data.role == 'user') {--}}
    {{--                        window.location.href = {{route('/')}};--}}
    {{--                    } else {--}}
    {{--                        window.location.href = {{route('admin.dashboard')}}--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    window.location.href = {{route('login')}};--}}
    {{--                }--}}

    {{--            }).catch(error => {--}}
    {{--                console.log(error);--}}
    {{--            })--}}
    {{--    ;--}}
    {{--}--}}

</script>
