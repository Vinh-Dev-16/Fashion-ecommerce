@extends('user.layout')
@section('title')
    Trang tạo thông tin của {{ Auth::user()->name }}
@endsection
@section('content')
    <div class="form_information">
        <div class="container_information">
            <div class="title">Trang thông tin</div>
            <div class="content">
                @if ($user->information)
                    <form action="{{ url('information/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="user-details">
                            <input type="text" name="user_id" value="{{ $user->information->id }}" hidden>
                            <div class="input-box">
                                <span class="details">Full Name</span>
                                <input type="text" value="{{ $user->information->fullname }}" name="fullname">
                            </div>
                            <div class="input-box">
                                <span class="details">Phone</span>
                                <input type="tel" name="phone" value="{{ $user->information->phone }}">
                            </div>
                            <div class="input-box">
                                <span class="details">Địa chỉ</span>
                                <input type="text" name="address" value="{{ $user->information->address }}">
                            </div>
                            <div class="input-box">
                                <span class="details">Sinh nhật</span>
                                <input type="date" value="{{ $user->information->birthday }}" name="birthday">
                            </div>
                            <div class="input-box">
                                <span class="details">Sở thích</span>
                                <input type="text" value="{{ $user->information->hobbies }}" name="hobbies">
                            </div>
                            <div class="input-box">
                                <span class="details">Ảnh đại diện</span>
                                <input type="file" name="avatar">
                                @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-box" style="width: 80%" >
                                <span class="details">Sở thích</span>
                                <input type="text" value="{{ $user->information->description }}" name="description" style="width: 100%">
                            </div>
                        </div>
                        <div>
                            <span class="detail"> Avatar trước đó: </span>
                            <img src="{{ asset('storage/avatar/' . $user->information->avatar) }}"
                                style="width:13%; margin: 1em 0">
                        </div>
                        <div class="gender-details">
                            <input type="radio" name="gender" value="male"
                                {{ 'male' == $user->information->gender ? 'checked' : '' }} id="dot-1">
                            <input type="radio" name="gender" value="female"
                                {{ 'female' == $user->information->gender ? 'checked' : '' }} id="dot-2">
                            <span class="gender-title">Gender</span>
                            <div class="category">
                                <label for="gender">Male</label>
                                <input style="display: block" type="radio" name="gender"
                                    {{ 'male' == $user->information->gender ? 'checked' : '' }} value="male">
                                <label for="gender">Female</label>
                                <input style="display: block" type="radio" name="gender"
                                    {{ 'female' == $user->information->gender ? 'checked' : '' }} value="female">
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                @else
                    <form action="{{ url('information/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="user-details">
                            <input type="text" name="user_id" value="{{ $user->id }}" hidden>
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
                @endif
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        let myEditor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

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
    </script>
@endsection
