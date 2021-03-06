<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->

    {!!Html::style('css/bootstrap.min.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('css/font-awesome.min.css')!!}
    <!-- Ionicons -->
    {!!Html::style('css/ionicons.min.css')!!}

    {!!Html::style('sweetalert2/dist/sweetalert2.min.css')!!}


    <!-- Theme style -->
    {!!Html::style('css/AdminLTE.min.css')!!}


    {!!Html::style('css/blue.css')!!}


    @yield('style')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>|C-S-P</b>|CMS|</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body ">
    <p class="login-box-msg ">Sign in to start your session</p>

    <form action="{{route('postLogin')}}" method="post" autocomplete="off">
    {!! csrf_field() !!}

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-envelope"></i>
            </div>
          <input type="altuser_id" class="form-control" placeholder="ID" name="altuser_id" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-lock"></i>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
          </div>
        </div>
      <div>
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button><br>
        </div>
        <!-- /.col -->
      </div>
      <div >
        <a href="{{route('forgotPassword')}}"><center> I forgot my password</center></a>
      </div>
    </form>

    <!-- <a >I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>

{!!Html::script('js/jquery.min.js')!!}
<!-- Bootstrap 3.3.6 -->
{!!Html::script('js/bootstrap.min.js')!!}
<!-- AdminLTE App -->
{!!Html::script('js/app.min.js')!!}
{!!Html::script('sweetalert2/dist/sweetalert2.min.js')!!}

@include('sweet::alert')

@yield('script')
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>