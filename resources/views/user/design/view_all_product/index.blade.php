@extends('user.layout')
@section('title')
  Các sản phẩm
@endsection
@section('content')

        <h1 class="search_page">Tất cả sản phẩm</h1>

        <div class="features">
            <div class="container">
                <div class="wrapper">
                    <div class="column" id="show-data">
                        @include('user.design.view_all_product.list_data')
                    </div>
                </div>
            </div>
        </div>



@endsection

@section('javascript')
    @include('user.design.view_all_product.script')
@endsection
