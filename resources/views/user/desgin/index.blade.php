@extends('user.layout')
@section('content')
    <div class="home_index">
        <div class="swiper">
        <div class="slider_index swiper-wrapper">
           <div class="slider swiper-slide" style="background:url({{asset('images/banner1.jpg')}}) no-repeat;">
           <div class="content_slider">
            <span class="title_slider">Sale Lên Tới 25%</span>
            <h3 class="trademark">FASHION SHOP</h3>
            <h3 class="title_countdown">Số ngày còn sale:</h3>
            <div class="countdown">
                <div class="box_countdown">
                    <h3 class="days" style="color: green">00</h3>
                    <span style="color: green">Ngày</span>
                </div>
                <div class="box_countdown">
                    <h3 class="hours">00</h3>
                    <span style="color: orange">Giờ</span>
                </div>
                <div class="box_countdown">
                    <h3 class="minutes" style="color: red">00</h3>
                    <span style="color: red">Phút</span>
                </div>
                <div class="box_countdown">
                    <h3 class="seconds" style="color: blue">00</h3>
                    <span style="color: blue">Giây</span>
                </div>
            </div>
            <button style="background-image: url({{asset('images/button.png')}})">SHOP NOW<button>
           </div>
        </div>
          <div class="slider swiper-slide" style="background:url({{asset('images/banner2.jpg')}}) no-repeat;">
            <div class="content_slider">
             <span class="title_slider">Sale Lên Tới 25%</span>
             <h3 class="trademark">FASHION SHOP</h3>
             <div class="countdown">
                <h3>Sale Sập Sàn <br><span>Tất Cả Các Sản Phẩm</span></h3>
             
            </div>
            <button style="background-image: url({{asset('images/button.png')}})">SHOP NOW<button>
        </div>
        </div>
         <div class="slider swiper-slide" style="background:url({{asset('images/banner3.jpg')}}) no-repeat;">
             <div class="content_slider">
              <span class="title_slider">Sale Lên Tới 25%</span>
              <h3 class="trademark">FASHION SHOP</h3>
              <h3 class="title_countdown">Số ngày còn sale:</h3>
              <div class="countdown">
                 
             
             </div>
             <button style="background-image: url({{asset('images/button.png')}})">SHOP NOW<button>
          </div>
    </div>
    </div>
    <div class="swiper-pagination"></div>
        </div>
    </div>
    {{-- @yield('landing') --}}
@endsection