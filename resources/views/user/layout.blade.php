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
    <div class="progress_bar">
        <div class="value"></div>
    </div>
    <header class="head_index">
        <div class="head_flex">
            <div class="logo_index">
                <h2>FASHION</h2>
            </div>
        <nav class="navbar">
            <a href="">TRANG CHỦ</a>
            <a href="">HÀNG MỚI NHẬP</a>
            <a href="">WOMEN</a>
            <a href="">MEN</a>
            <a href="">KHÁM PHÁ</a>
        </nav>
           <div class="search_form">
            <form action="" method="POST">
                @csrf
              <input type="text" name="search" id="search_text" placeholder="Nhập tên sản phẩm" required>
              <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
           </div>
           <div class="icon_header">
            <i class="fa-regular fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
            <i class="fa-regular fa-heart"></i>
           </div>
           </div>
        </div>
        </header>
    <div class="container">
        <div class="index_fashion">   
            @section('content')
            @show
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>  
    <script>
      //Phan text
      var typingEffect = new Typed(".multi_text",{
        strings: ['FASHION AND SO MUCH MORE'],
        loop:true,
        typeSpeed: 100,
        backSpeed: 60,
        backDelay: 1500,
        showCursor: true,
        cursorChar: '|',
        autoInsertCss: true
      })
      // Phần progress bar
      document.addEventListener('DOMContentLoaded',()=>{
        const value = document.querySelector('.value');
        document.addEventListener('scroll',()=>{
        const scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
         const scrollHeight = document.documentElement.scrollHeight;
        const clienHeight = document.documentElement.clientHeight;
      
        const percentage = Math.floor(scrollTop / (scrollHeight-clienHeight) * 100);
        value.style.width= percentage + '%';
        
      });
      });
     
 
     // Phan scroll
     const home_landing = document.querySelector('.back_home');
     const landing = document.querySelector('.landing_home');
     const home_index = document.querySelector('.home_index');
     home_landing.onclick = function(){
                landing.classList.toggle('active');
                home_index.classList.toggle('active');

            }
    </script>  
</body>
</html>