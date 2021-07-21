
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SKULLNET.CC @if(isset($title)) | {{ $title }} @endif </title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login" style="background-image: url('{{ asset("images/skull-wallpaper-2.jpg") }}');
  background-size:cover;
  background-position:center;
  min-height:90vh;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;">
    <div>

      <div class="login_wrapper" style="margin-top:-5px;">
        <div class="animate form login_form">
          <section class="login_content" style="background-color: #2B3C52;
          margin: 10% auto 0 auto; padding:10px;
          color:#fff;
          box-shadow: 0px 0px 7px 5px #969DA5;
          ">
            <form action="{{route('admin.login.submit')}}" method="POST">
                @csrf
              <h1>Admin Login</h1>

              @if(session()->has('error'))
            <p style="font-size: 14px; color: yellow; text-align:center;">{{ session('error') }}</p>
            @endif

            @if(session()->has('success'))
            <p style="font-size: 14px; color: yellow; text-align:center;">{{ session('success') }}</p>
            @endif

              <div>
                <input type="text" name="email" class="form-control" placeholder="Email" />
                @if($errors->has('email'))
                <p style="font-size: 12px; color: yellow;">{{ $errors->first('email') }}</p>
                @endif
              </div>

              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" />
                @if($errors->has('password'))
                <p style="font-size: 12px; color: yellow;">{{ $errors->first('password') }}</p>
                @endif
              </div>

              <div>
                    <button type="submit" class="btn btn-danger btn-sm">Log in</button>
              </div>

              <div class="mt-2">
                <p style="font-size: 12px; text-align:center;">Please type the Number EXACTLY like in number box</p>
              </div>

              <div class="row">

                <div class="col-md-5 col-xs-5">
                    <?php
                        $captchaImage = null;
                        for($i = 0; $i < 5; $i++){  $captchaImage .= mt_rand(0, 9);}
                    ?>
                    <input type="text" class="form-control" value="{{ $captchaImage }}" disabled />
                    <input type="hidden" class="form-control" value="{{ $captchaImage }}" name="captcha_image" />
                </div>

                <div class="col-md-7">
                    <input type="text" class="form-control" placeholder="Enter CAPTCHA" name="captcha_text" />
                </div>

               </div>

               @if(session()->has('captcha_error'))
                <div>
                    <p style="text-align: center; color: yellow">{{ session('captcha_error') }}</p>
                </div>
                @endif

                @if($errors->has('captcha_text'))
                <p style="font-size: 12px; color: yellow;">{{ $errors->first('captcha_text') }}</p>
                @endif

              <div class="clearfix"></div>


              <div class="separator">
                <div>
                <h1><i class="fa fa-paw"></i> SkullNet.cc</h1>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
