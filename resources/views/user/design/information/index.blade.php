@extends('user.layout')
@section('title')
    Trang thông tin của {{Auth::user()->name}}
@endsection
@section('content')

    <h1 class="search_page">Trang thông tin cá nhân của {{Auth::user()->name}} </h1>

    <div class="page_single">
        <div class="container" >
            <div class="wrapper" style="border: 1px solid #e5e8ec;min-height:100vh">
                <div class="head_information">
                    <div class="user_information">
                        <div class="avatar object-cover">
                            <img src="{{asset('images/user.png')}}" alt="Ảnh đại diện">
                        </div>
                        <div class="text_content">
                            <p>Tên user:{{Auth::user()->name}}</p>
                            <p>Email: {{Auth::user()->email}}</p>
                        </div>
                    </div>
                    </div>
                <div class="body_information">
                    <div class="infor">
                        <h2>Thông tin cá nhân</h2>
                        <div>
                            <ul>
                                <li>Số điện thoại: </li>
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
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')

<script>
        const dpt_menu = document.querySelector('.dpt_menu');
        const close_menu = document.getElementById('close_menu');

        dpt_menu.classList.add('active');

        close_menu.addEventListener('click', (e) => {
            e.preventDefault();
            dpt_menu.classList.toggle('active');
        });
</script>
@endsection