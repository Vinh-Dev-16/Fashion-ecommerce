@extends('user.layout')
@section('title')
    Trang tạo thông tin của {{Auth::user()->name}}
@endsection
@section('content')
    <div class="form_information">
        <div class="container_information">
        <div class="title">Trang thông tin</div>
        <div class="content">
          @if ($user->information)
          <form action="{{url('information/store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
              <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" placeholder="Enter your name">
              </div>
              <div class="input-box">
                <span class="details">Username</span>
                <input type="text" placeholder="Enter your username">
              </div>
              <div class="input-box">
                <span class="details">Email</span>
                <input type="text" placeholder="Enter your email">
              </div>
              <div class="input-box">
                <span class="details">Phone Number</span>
                <input type="text" placeholder="Enter your number">
              </div>
              <div class="input-box">
                <span class="details">Password</span>
                <input type="text" placeholder="Enter your password">
              </div>
              <div class="input-box">
                <span class="details">Confirm Password</span>
                <input type="text" placeholder="Confirm your password">
              </div>
            </div>
            <div class="gender-details">
              <input type="radio" name="gender" id="dot-1">
              <input type="radio" name="gender" id="dot-2">
              <input type="radio" name="gender" id="dot-3">
              <span class="gender-title">Gender</span>
              <div class="category">
                <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
              </label>
              <label for="dot-3">
                <span class="dot three"></span>
                <span class="gender">Prefer not to say</span>
                </label>
              </div>
            </div>
            <div class="button">
              <input type="submit" value="Submit">
            </div>
          </form> 
          @else
          <form action="{{url('information/store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
              <input type="text" name="user_id" value="{{$user->id}}" hidden>
              <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" placeholder="Điền họ tên đầy đủ" name="fullname" >
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
              <button type="submit" class="primary_button btn_information" >Submit</button>
            </div>
          </form>   
          @endif
        </div>
      </div>
    </div>

@endsection
@section('javascript')

<script>

        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

        const dpt_menu = document.querySelector('.dpt_menu');
        const close_menu = document.getElementById('close_menu');

        dpt_menu.classList.add('active');

        close_menu.addEventListener('click', (e) => {
            e.preventDefault();
            dpt_menu.classList.toggle('active');
        });
</script>
@endsection