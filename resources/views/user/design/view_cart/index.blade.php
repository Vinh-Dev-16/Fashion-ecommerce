@extends('user.layout')
@section('title')
    Trang giỏ hàng của bạn
@endsection
@section('content')
    <ul class="notification">
    </ul>
    <div id="show-data">
        @if(Session::has('selectedCart') && count(Session::get('selectedCart')) > 0)
            @include('user.design.view_cart.list_cart_selected')
        @else
            @include('user.design.view_cart.list_data')
        @endif
    </div>

@endsection

@section('javascript')
    @include('user.design.view_cart.script')
@endsection
