@extends('user.layout')
@section('content')
    <div class="home_index">
        <div class="slider_index">
           <div class="slider" style="background:url({{asset('images/banner1.jpg')}}) no-repeat;">
           <div class="content_slider">
            <span class="title_slider">Sale Lên Tới 25%</span>
            <h3 class="trademark">FASHION SHOP</h3>
            <h3 class="title_countdown">Số ngày còn sale:</h3>
            <div class="countdown">
                <div class="box_countdown">
                    <h3 id="days" style="color: green">00</h3>
                    <span style="color: green">Ngày</span>
                </div>
                <div class="box_countdown">
                    <h3 id="hours">00</h3>
                    <span style="color: orange">Giờ</span>
                </div>
                <div class="box_countdown">
                    <h3 id="minutes" style="color: red">00</h3>
                    <span style="color: red">Phút</span>
                </div>
                <div class="box_countdown">
                    <h3 id="seconds" style="color: blue">00</h3>
                    <span style="color: blue">Giây</span>
                </div>
            </div>
            <button style="background-image: url({{asset('images/button.png')}})">SHOP NOW<button>
           </div>
        </div>
    </div>
    {{-- @yield('landing') --}}
@endsection