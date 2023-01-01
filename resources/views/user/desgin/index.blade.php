@extends('user.layout')
@section('content')
    <div class="home_index">
        <div class="slider_index">
            <img src="{{asset('images/slider1.jpg')}}" alt="Ảnh 1">
            <img src="{{asset('images/slider1.jpg')}}" alt="Ảnh 1">
            <img src="{{asset('images/slider1.jpg')}}" alt="Ảnh 1">
            <img src="{{asset('images/slider1.jpg')}}" alt="Ảnh 1">
            <img src="{{asset('images/slider1.jpg')}}" alt="Ảnh 1">

        </div>
    </div>
    @yield('landing')
@endsection