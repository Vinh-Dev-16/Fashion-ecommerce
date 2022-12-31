<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('user/user.css')}}">
    <title>Trang chủ</title>
</head>
<body>
    <div class="container">
        <div class="landing" style="background-image: url({{asset('images/banner-bg.png')}})">   
            @yield('landing')
        </div>
        {{-- @yield('content') --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>  
    <script>
      //Phan text
      var typingEffect = new Typed(".multi_text",{
        strings: ['FASHION AND SO MUCH MORE'],
        loop:true,
        typeSpeed: 100,
        backSpeed: 50,
        backDelay: 1000,
        showCursor: true,
        cursorChar: '|',
        autoInsertCss: true
      })
     // Phan scroll
     const home_landing = document.querySelector('.back_home');
     const landing = document.querySelector('.landing');
     home_landing.onclick = function(){
                landing.classList.toggle('active');
            }
    </script>  
</body>
</html>