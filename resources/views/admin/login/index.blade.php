<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reign Buy Sell | Login</title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {{Form::open(array('url' => 'login' , 'method' => 'POST'))}}
              <h1>Reign Buy Sell</h1>
              <div>
                <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username" value="admin" required="" />
                
              </div>
              <div>
                <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password" value="1234" required="" />
                
              </div>
              <div>
                
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
                  @if ($message = Session::get('warning'))
                    <div style="text-align: center; color: #828282; background-color: #A3E4D7; display: block; border-radius: 5px;">
                       <span>{{ $message }}</span>
                    </div>
                  @endif

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  
                  <p>©2020 All Rights Reserved |<a href="http://easysoftwaresolution.com/"> Easy Software Solution</a></p>
                </div>
              </div>
            {{ Form::close() }}
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
