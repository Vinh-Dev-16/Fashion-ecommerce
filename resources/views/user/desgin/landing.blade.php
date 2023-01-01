@extends('user.desgin.index')
@section('landing')
  <div class="landing_home" class="landing_home" style="background-image: url({{asset('images/banner-bg.png')}})">
  <nav>
    <h2>FASHION</h2>
  </nav>
  <section >
    <div class="flex_lading">
    <div class="text_landing">
        <p>WEB</p>
        <h1 style="background-image: url({{asset('images/back.png')}})">FASHION</h1>
        <h3> <span class="multi_text"></span></h3>
        <div class="back_home">
        <a href="#"><i class="fa-solid fa-house"></i> Trang chủ</a>
        </div>
    </div>
    <div class="animation_lading">
        <div class="astronayts">
        <img src="https://raw.githubusercontent.com/judygab/web-dev-projects/3099dfd4ab2683c422e0f4e662d84b8a147db245/personal-portfolio/src/assets/img/header-img.svg" alt="ảnh animated">
        </div>
        <div class="social_lading">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-github"></i></a>
        </div>        
    </div>
    </div>
  </section>
  </div>
@endsection