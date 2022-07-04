<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Forgot Password</title>
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
    <style type="text/css">
      input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none;
          -moz-appearance: none;
          appearance: none;
          margin: 0; 
      }
    </style>

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
      <div class="login-box-body box">
        <p class="login-box-msg">Provide your Branch and Mobile number</p>
        <form action="home.html" method="post" id="HomeForm">
          <label>Select your Branch</label>
          <div class="form-group has-feedback mail-group">            
            <select class="form-control" id="branch">
            </select>   
          </div>
          <div class="form-group has-feedback mobile-group">    
            <label>Mobile No</label> &nbsp; (10 digits)        
            <input id="mobile" type="number" class="form-control" placeholder="Mobile" autocomplete="off">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            <label class="control-label mobile-error" for="inputError" style="display:none"><i class="fa fa-times-circle-o"></i> please provide 10 digit mobile no</label>
          </div>
          <div class="form-group has-feedback password-group">
            <canvas id="canvas"></canvas>
          </div>
          <div class="form-group has-feedback captcha-group">
            <input class="form-control" name="code" placeholder="captcha"/>
            <label class="control-label captcha-error" for="capthaError" style="display:none"><i class="fa fa-times-circle-o"></i> Invalid Captcha</label>
          </div>
          <p class="login-box-msg text-red error-message" style="display:none">Email not exist</p>
          <p class="login-box-msg text-green success-message" style="display:none"></p>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="button" id="SignIn" class="btn btn-primary btn-block btn-flat">Submit 
              </button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="register.html">New user</a><br>
        <a href="login.html" class="text-center">I already have a account</a>
        <div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>

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
    <!-- Config and Common -->
    <script src="plugins/js/forgot.js"></script>

    <script src="plugins/alphanumeric-captcha/js/jquery-captcha.min.js"></script>
    
  </body>
</html>
<!--
https://mandrillapp.com/api/docs/messages.JSON.html#method=send

https://www.ventureharbour.com/transactional-email-service-best-mandrill-vs-sendgrid-vs-mailjet/
-->