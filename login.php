<?php
  ini_set("session.cookie_httponly", 1);
  ini_set('session.cookie_secure', 1);
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="assets/images/favicon.png" rel="shortcut icon">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Muthoot</b>One</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="home.html" method="post" id="HomeForm">
          <div class="form-group has-feedback mail-group">            
            <input id="email" type="email" class="form-control" placeholder="Email" autocomplete="off">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <label class="control-label email-error" for="inputError" style="display:none"><i class="fa fa-times-circle-o"></i> please provide your email</label>
          </div>
          <div class="form-group has-feedback password-group">
            <input id="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <label class="control-label password-error" for="inputError" style="display:none"><i class="fa fa-times-circle-o"></i> please provide your password</label>
          </div>

          <!-- 
          <div class="form-group has-feedback password-group">
            <canvas id="canvas"></canvas>
          </div>
          <div class="form-group has-feedback captcha-group">
            <input class="form-control" name="code" placeholder="captcha"/>
            <label class="control-label captcha-error" for="capthaError" style="display:none"><i class="fa fa-times-circle-o"></i> Invalid Captcha</label>
          </div> -->
          
          <div class="form-group has-feedback captcha-group">
            <p>
            <a href="#" onclick="
                document.getElementById('captcha-img').src = 'captcha.php?' + Math.random();
                document.getElementById('captcha').value = '';
                return false;
              ">
              <img src="captcha.php" width="220" height="40" alt="CAPTCHA" id="captcha-img"></a></p>
            <p><input class="form-control" type="text" placeholder="captcha" size="6" maxlength="5" id="captcha" value=""><br>
          </div>

          <p class="login-box-msg text-red error-message" style="display:none">Unauthorized Access</p>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" id="RemeberMe"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="button" <?php echo (isset($_SESSION['invalid-attempt-timestamp']) && ((strtotime(date("YmdHis")) - $_SESSION['invalid-attempt-timestamp']) <= 60)) ? "disabled" : '' ?> id="SignIn" class="btn btn-primary btn-block btn-flat">Sign In 
                <i class="fa fa-spinner fa-spin loader" style="display:none"></i>
              </button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="forgot.html">I forgot my password</a><br>
        <a href="register.html" class="text-center">New user</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 3.6.0 -->
    <script src="plugins/jQuery/jQuery-3.6.0.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- MD5 -->
    <script src="plugins/md5/jquery.md5.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <!-- Login -->
    <script src="plugins/js/login.js?rand=1910"></script>

    <script src="plugins/alphanumeric-captcha/js/jquery-captcha.min.js"></script>

  </body>
</html>
