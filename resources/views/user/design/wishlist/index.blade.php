@extends('user.layout')
@section('title')
    Danh sách yêu thích của bạn
@endsection
@section('content')
    @if (Auth::check())
        <div id="show-data">
          @include('user.design.wishlist.list_data')
        </div>
    @endif


@endsection


@section('javascript')
    @include('user.design.wishlist.script')

@endsection
