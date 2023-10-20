@extends('user.layout')
@section('title')
   Thêm địa chỉ của {{ Auth::user()->name }}
@endsection

@section('content')

@endsection
@section('javascript')
    @include('user.design.information.script')
@endsection
