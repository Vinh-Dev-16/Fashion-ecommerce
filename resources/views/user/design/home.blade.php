@extends('user.layout')
@section('content')
    <div class="flex home_user" style="background-image: url({{asset('images/bg1.jpg')}});  filter: brightness(0.9);">
        <div class="text_slider">
        </div>
        <div class="slider_animation">
            <img src="{{asset('images/ani1.png')}}" alt="slider1" class="ani1">
            <div class="img_slider slider1" style="background-image: url('{{asset('images/slider1.png')}}')"></div>
            <img src="{{asset('images/ani2.png')}}" alt="slider2" class="ani2">
            <div class="img_slider slider2" style="background-image: url('{{asset('images/slider2.png')}}')"></div>
            <img src="{{asset('images/ani3.png')}}" alt="slider3" class="ani3">
            <div class="img_slider slider3" style="background-image: url('{{asset('images/slider3.png')}}')"></div>
        </div>
    </div>
    <div class="category_home">
        <h3> Brand Fashion </h3>
        <div class="img_category">
            <img src="{{asset('images/woman.png')}}" alt="woman">
            <img src="{{asset('images/man.png')}}" alt="man">
            <img src="{{asset('images/shoe.png')}}" alt="shoe">
            <img src="{{asset('images/perfume.png')}}" alt="perfume">
            <img src="{{asset('images/bag.png')}}" alt="bag">
        </div>
    </div>

   
@endsection
