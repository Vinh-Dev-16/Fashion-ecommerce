<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('user/user.css')}}">
    <title>Register</title>
</head>
<body>
    <div class="wrapper_res" style=" background-image: linear-gradient(0deg,rgba(0,0,0,.8) 0,transparent 60%,rgba(0,0,0,.8)),
    url('{{asset('images/banner-bg.png')}}');">
        <div class="main_container">
    <form action="" method="POST" class="form" id="form-1" role="form">
        <h3 class="heading">Đăng ký tài khoản</h3>
        <div class="spacer"></div>
        <div class="form-group">
            <input id="username" required placeholder=" " name="username" type="text" class="form-control" value="">
            <label for="username" class="form-label">Username</label>
          </div>
        <div class="form-group">
            <input id="password" required placeholder=" " name="password" type="password" class="form-control" value="">
            <label for="password" class="form-label">Mật khẩu</label>
          </div>
  
          <div class="form-group">
            <input id="password_confirmation" required placeholder=" " name="repassword" type="password" class="form-control" value="">
            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
          </div>
          <div class="form-group">
            <input id="remember_me" name="remember_me" type="checkbox">
            <label for="remember_me" class="form-label remember ">Remember me</label>
          </div>
          <button id="button" class="form-submit" name="submit" type="submit">Đăng ký</button>
          <div class="sign-in">
            Bạn đã có tài khoản?
            <a href="">Đăng nhập</a>
          </div>
     </form>
     
    </div>
   </div>
</body>
</html>