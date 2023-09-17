@extends('user.layout')
@section('title')
    Trang giỏ hàng của bạn
@endsection
@section('content')
    <ul class="notification">
    </ul>
    <div id="show-data">
        @include('user.design.view_cart.list_data')
    </div>

@endsection

@section('javascript')
  @include('user.design.view_cart.script')
@endsection
