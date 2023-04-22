@extends('user.layout')
@section('title')
    Đăng kí làm shipper
@endsection
@section('content')

    @if (App\Models\Information::where('user_id', Auth::user()->id)->count() > 0)
        <div class="single_checkout">
            <div class="container">
                <div class="wrapper">
                    <div class="breadcrumb">
                        <ul class="flexitem">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Đăng kí làm shipper</li>
                        </ul>
                    </div>
                    <div class="checkout">
                        <div class="left styled" style="padding:4em 0">
                            <h1 style="text-align:center">Thông tin đăng kí</h1>
                            <form action="{{ url('/shipperSuccess') }}" method="POST">
                                @csrf
                                @foreach (App\Models\Information::where('user_id', Auth::user()->id)->get() as $information)
                                    <p style="width:60%; margin-left:20%">
                                        <label for="fullname">Full Name<span></span></label>
                                        <input type="text" name="fullname" value="{{ $information->fullname }}">
                                    </p>
                                    <p style="width:60%; margin-left:20%">
                                        <label for="phone">Phone<span></span></label>
                                        <input type="phone" name="phone" value="{{ $information->phone }}">
                                    </p>
                                    <p style="width:60%; margin-left:20%">
                                        <label for="address">Address<span></span></label>
                                        <input type="text" name="address" value="{{ $information->address }}">
                                    </p style="width:60%; margin-left:20%">
                                    <input type="date" name='birthday' value="{{ $information->birthday }}" hidden>
                                @endforeach
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                @error('birthday')
                                    <div class="text-danger">Bạn phải trên 18 tuổi mới được đăng kí</div>
                                @enderror
                                <p style="width:60%; margin-left:20%">
                                <div class="primary_checkout"><button class="primary_button"
                                        type="s
                                  ">Đăng kí làm Shipper</button></div>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="page_single">
            <div class="container">
                <div class="wrapper">
                    <div class="breadcrumb">
                        <ul class="flexitem">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Trang thông tin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="form_information">
            <div class="container_information">
                <div class="title">Trang thông tin</div>
                <div class="content">
                    <form action="{{ url('shipper/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="user-details">
                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                            <div class="input-box">
                                <span class="details">Full Name</span>
                                <input type="text" placeholder="Điền họ tên đầy đủ" name="fullname">
                                @error('fullname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Phone</span>
                                <input type="tel" name="phone" placeholder="Điền số điện thoại">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Địa chỉ</span>
                                <input type="text" name="address" placeholder="Điền địa chỉ">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Sinh nhật</span>
                                <input type="date" placeholder="Enter your number" name="birthday">
                                @error('birthday')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Sở thích</span>
                                <input type="text" placeholder="Điền sở thích" name="hobbies">
                                @error('hobbies')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Ảnh đại diện</span>
                                <input type="file" name="avatar">
                                @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <textarea type="text" id="editor" name="description" placeholder="Mô tả về bản thân bạn"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="gender-details">
                            <input type="radio" name="gender" value="male" id="dot-1">
                            <input type="radio" name="gender" value="female" id="dot-2">
                            <span class="gender-title">Gender</span>
                            <div class="category">
                                <label for="dot-1">
                                    <span class="dot one">Male</span>
                                    <input type="radio" name="gender" value="male">
                                </label>
                                <label for="dot-2">
                                    <span class="dot two">Female</span>
                                    <input type="radio" name="gender" value="female">
                                </label>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="primary_button btn_information">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('javascript')
    <script>
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');

        for (let i of dpt_menu) {
            i.classList.add('active');
        }
        close_menu.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                for (let i of dpt_menu) {
                    i.classList.toggle('active');
                }
            });
        })

        let myEditor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
