@extends('user.layout')
@section('title')
    Trang thông tin của {{ Auth::user()->name }}
@endsection
@section('content')

    <h1 class="search_page">Trang thông tin cá nhân của {{ Auth::user()->name }} </h1>

    <div class="page_single">
        <div class="container">
            <div class="wrapper" style="border: 1px solid #e5e8ec;">
                <div class="breadcrumb" style="margin: 10px">
                    <ul class="flexitem">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Trang thông tin</li>
                    </ul>
                </div>
                <div class="head_information">
                    <div class="user_information">
                        <div class="avatar object-cover">
                            @if ($user->information)
                                <img src="{{ asset('storage/avatar/' . $user->information->avatar) }}" alt="">
                            @else
                                <img src="{{ asset('images/user.png') }}" alt="Ảnh đại diện">
                            @endif
                        </div>
                        <div class="text_content">
                            <p>
                                <i class="ri-speak-line"></i>
                                Tên user: {{ Auth::user()->name }}</p>
                            <p>Email: {{ Auth::user()->email }}</p>
                            @if ($user->information)
                                <p>Giới thiệu: {!! $user->information->description !!}</p>
                            @else
                                <p>Chưa có giới thiệu</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="body_information">
                    <div style="display: flex; flex: 1 2;">
                        <div class="sidebar_info">
                            <ul>
                                <li>
                                    <a href="{{url('information/' . $user->id)}}" style="height: 73.7px">
                                        <div class="icon_large">
                                            <i class="ri-home-line"></i>
                                        </div>
                                        Trang chủ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('information/edit/' . $user->id)}}" style="height: 73.7px">
                                        <div class="icon_large">
                                            <i class="ri-article-line"></i>
                                        </div>
                                        Chỉnh sửa thông tin
                                    </a>
                                </li>
                                <li>
                                    <a style="height: 73.7px">
                                        <div class="icon_large">
                                            <i class="ri-exchange-funds-line"></i>
                                        </div>
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                @if(!empty($user->information->address))
                                    <li>
                                        <a href="{{url('information/edit-address/' . $user->id)}}" style="height: 73.7px">
                                            <div class="icon_large">
                                                <i class="ri-edit-box-line"></i>
                                            </div>
                                            Đổi địa chỉ
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{url('information/create-address/' . $user->id)}}" style="height: 73.7px">
                                            <div class="icon_large">
                                                <i class="ri-add-circle-line"></i>
                                            </div>
                                            Thêm địa chỉ
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @if ($user->information)
                            <div class="infor" style="width: 100%">
                                <h2 class="search_page">Thông tin cá nhân</h2>
                                <div class="text_content">
                                    <ul>
                                        <li>Tên đầy đủ: {{ $user->information->fullname }}</li>
                                        <li>Số điện thoại: {{ $user->information->phone }} </li>
                                        <li>Địa chỉ: {{ $user->information->address }}</li>
                                    </ul>
                                    <ul>
                                        <li>Ngày sinh: {{ $user->information->birthday }}</li>
                                        @if ($user->information->gender == 'male')
                                            <li>Giới tính: Nam</li>
                                        @else
                                            <li>Giới tính: Nữ</li>
                                        @endif
                                        <li>Sở thích: {{ $user->information->hobbies }}</li>
                                    </ul>
                                </div>
                            </div>

                        @else
                            <div class="infor" style="width: 100%">
                                <h2 class="search_page">Thông tin cá nhân</h2>
                                <a class="primary_button" style="margin-left: 30px"
                                   href="{{ url('information/edit/' . Auth::user()->id) }}">Điền thông tin</a>
                                <div class="text_content">
                                    <ul>
                                        <li>Số điện thoại:</li>
                                        <li>Địa chỉ:</li>
                                        <li>Ngày sinh:</li>
                                    </ul>
                                    <ul>
                                        <li>Giới tính:</li>
                                        <li>Sở thích:</li>
                                        <li>Giới thiệu sơ về bản thân:</li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');

        for (let i of dpt_menu) {
            i.classList.add('active')
        }
        close_menu.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                for (let i of dpt_menu) {
                    i.classList.toggle('active');
                }
            })
        })
    </script>
@endsection
