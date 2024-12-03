<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset("admin/ad_css/login/login.css")}}">
</head>
<body>
        {{-- @if(Session::has('success')) 
                <div class="alert-login alert alert-success">{{ Session :: get('success') }}</div>
        @endif --}}
    
        @if(Session::has('error'))
            <div class="alert-login alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    {{-- <video autoplay muted loop id="myVideo">
        <source src="https://videos.pexels.com/video-files/2915051/2915051-hd_1920_1080_25fps.mp4" type="video/mp4">
       
      </video> --}}
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-6"> 
                 <div class="card"> 
                    <form action="" class="box box-login" method="POST"> 
                        @csrf
                            <h1>Login</h1> 
                            <p class="text-muted"> Hãy nhập mã số đăng nhập và mật khẩu !</p>
                            <input type="text" name="mssv" placeholder="Mã số đăng nhập" value="{{session('remember_mssv') }}"> 
                                <div class="error_username" style="color: red;"> 
                                    @error('mssv') 
                                            <small> Vui lòng nhập mã số !</small>
                                    @enderror
                                </div>
                            <input type="password" name="pass" id="pass" placeholder="Mật khẩu" value="{{session('remember_pass_sv') }}"> 
                                <div class="error_username" style="color: red;"> 
                                    @error('pass') 
                                            <small> Vui lòng nhập mật khẩu ! </small>
                                    @enderror
                                </div>
                            <div class="show_pass">
                                <input type="checkbox" id="showPasswordCheckbox" class="check__bock--pass" onchange="togglePasswordVisibility()">
                                <label for="showPasswordCheckbox" class="text__pass">Hiển thị mật khẩu</label><br>
                            </div>
                            
                            <div class="row container">
                                <div class="w-100 text-content">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" class="check__bock--remember" name="remember">
                                        <label for="remember" class="text__pass">Ghi nhớ </label><br>
                                    </div>
                                </div>
                            </div>
                            {{-- <a class="forgot text-muted" href="#">Quên mật khẩu?</a>  --}}
                            <input type="submit" name="" value="Đăng nhập" >
                            
                    </form> 
                </div> 
            </div>
        </div>
    </div>
    <script src="{{asset("admin/ad_js/login/login.js")}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>