<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
              <button type="button" id="SignIn" class="btn btn-primary btn-block btn-flat">Sign In 
                <i class="fa fa-spinner fa-spin loader" style="display:none"></i>
              </button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- MD5 -->
    <script src="plugins/md5/jquery.md5.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
        
        if(localStorage.getItem("rememberme") == 'true'){    
            $("#email").val(localStorage.getItem("email"));
            $("#password").val(localStorage.getItem("password"));
            $("#RemeberMe").iCheck('check');
        }
        else{
            $("#email").val('');
            $("#password").val('');
            $("#RemeberMe").attr('checked', false);
        }

        $( "#SignIn" ).click(function() {            
            if($.trim($("#email").val()) == ""){
                $(".mail-group").addClass("has-error");
                $(".email-error").show();
                $("#email").focus();
                return false;;
            }            
            if($.trim($("#password").val()) == ""){
                $(".password-group").addClass("has-error");
                $(".password-error").show();
                $("#password").focus();
                return false;;
            }
            $(".loader").show();
            if($("#RemeberMe:checked").length == 1){
                localStorage.setItem("email", $.trim($("#email").val()));
                localStorage.setItem("password", $("#password").val());
                localStorage.setItem("rememberme", true);
            }
            else{
                localStorage.removeItem("email");
                localStorage.removeItem("password");
                localStorage.removeItem("rememberme");
            }
            var person = {
                UserName: $.trim($("#email").val()),
                Password: $.md5($("#password").val())
            }
            jQuery.ajax({
                url: SERVICE_URL + 'GlCustomCustomer/GetCustomerDetails',
                method: "POST",    
                contentType: 'application/json',   
                data: JSON.stringify(person),                    
                beforeSend: function (xhr) {
                   xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                },
                error: function(xhr, status, error) {
                    $(".error-message").html("Sorry, could not able to connect the server. Please try again later");
                    $(".error-message").show();
                    $(".loader").hide();
                },
                success: function(data) {
                   if(data['status'] == "1"){
                      $("#HomeForm").submit();
                      localStorage.setItem("email", $.trim($("#email").val()));
                      localStorage.setItem("customerName", data['data']['customerName']);
                      localStorage.setItem("customerId", data['data']['id']);
                   }
                   else{
                      $(".error-message").show();
                      $(".loader").hide();
                   }
                }
           });

        });

        $('#email').on('keyup blur change', function(e) {
            $(".mail-group").removeClass("has-error");
            $(".email-error").hide();
        });

        $('#password').on('keyup blur change', function(e) {
            $(".password-group").removeClass("has-error");
            $(".password-error").hide();
        });

      });            
    </script>

  </body>
</html>
