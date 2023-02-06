@extends('user.layout')
@section('content')
    <div class="home_index">
        <div class="swiper">
            <div class="slider_index swiper-wrapper">
                <div class="slider swiper-slide" style="background:url({{ asset('images/banner1.jpg') }}) no-repeat;">
                    <div class="content_slider">
                        <span class="title_slider">Sale Lên Tới 25%</span>
                        <h3 class="trademark">FASHION SHOP</h3>
                        <h3 class="title_countdown">Số ngày còn sale:</h3>
                        <div class="countdown">
                            <h3>Sale Sập Sàn <br><span>Tất Cả Các Sản Phẩm</span></h3>

                        </div>
                        <button style="background-image: url({{ asset('images/button.png') }})">SHOP NOW<button>
                    </div>
                </div>
                <div class="slider swiper-slide" style="background:url({{ asset('images/banner2.jpg') }}) no-repeat;">
                    <div class="content_slider">
                        <span class="title_slider">Sale Lên Tới 25%</span>
                        <h3 class="trademark">FASHION SHOP</h3>
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
                        <button style="background-image: url({{ asset('images/button.png') }})">SHOP NOW<button>
                    </div>
                </div>
                <div class="slider swiper-slide" style="background:url({{ asset('images/banner3.jpg') }}) no-repeat; ">
                    <div class="content_slider">
                        <span class="title_slider">Sale Lên Tới 25%</span>
                        <h3 class="trademark">FASHION SHOP</h3>
                        <h3 class="title_countdown">Số ngày còn sale:</h3>
                        <div class="countdown">


                        </div>
                        <button style="background-image: url({{ asset('images/button.png') }})">SHOP NOW<button>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    {{-- Phần card --}}
    <section>
        <div class="card_category">
            <div class="card_category_title">
                <h2>CATEGORY</h2>
            </div>
            <div class="card_category_image woman_image">
                <img src="https://i.pinimg.com/564x/c5/3d/ce/c53dce17a0a33cadd6975318cefa9b2b.jpg" alt="Ảnh category woman">
                <div class="card_category_deces">
                    <h3>Woman</h3>
                    <p>Discount từ 20%-30%</p>
                    <a href="#" style="background-image: url({{ asset('images/button.png') }})">SHOP NOW</a>
                </div>
            </div>
            <div class="card_category_image man_image">
                <img src="https://i.pinimg.com/564x/37/80/39/3780391afef20e3caa6e8a9e9f729a44.jpg" alt="Ảnh category man">
            </div>
            <div class="card_category_image kid_image">
                <img src="https://i.pinimg.com/564x/8e/71/77/8e717780253630a46c76187844134741.jpg" alt="Ảnh category kid">
            </div>
            <div class="card_category_image glasses_image">
                <img src="https://i.pinimg.com/564x/83/4c/08/834c0898507df314c5a48279fc353adb.jpg"
                    alt="Ảnh category glasses" style="object-position: center">
            </div>
            <div class="card_category_image shoe_image">
                <img src="https://i.pinimg.com/564x/1e/bb/e5/1ebbe52f99591b237d63f63040c45435.jpg" alt="Ảnh category shoe"
                    style="object-position: center">
            </div>
        </div>
    </section>
    {{-- @yield('landing') --}}
@endsection
