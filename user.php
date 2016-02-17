<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Set Password</title>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" style="background-color: #ecf0f5">

        <header class="main-header">
          <!-- Logo -->
          <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">Muthoot</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Muthoot</b>One</span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top" role="navigation">          
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu pull-left">
                  <a>
                    <span>Welcome <b><span class="customer-name"></span></b></span>
                  </a>
                </li>     
              </ul>
            </div>
          </nav>
        </header>

        <div class="login-box" style="width:440px">
          <div class="login-box-body">
              <p class="login-box-msg">Please set your password</p>
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="Password" class="col-sm-5 control-label">Password</label>
                      <div class="col-sm-7 password-group">
                        <input type="password" class="form-control" id="password" placeholder="password">
                        <label class="control-label password-error" for="password" style="display:none"><i class="fa fa-times-circle-o"></i> Please provide password</label>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="Confirm Password" class="col-sm-5 control-label">Confirm Password</label>
                    <div class="col-sm-7 confirm-password-group">
                      <input type="password" class="form-control" id="confirm_password" placeholder="confirm password">
                      <label class="control-label confirm-password-error" for="confirm password" style="display:none"><i class="fa fa-times-circle-o"></i> password mismatch</label>
                    </div>      
                  </div>    
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" class="btn btn-info pull-right search">Submit
                    <i class="fa fa-spinner fa-spin loader" style="display:none"></i>
                  </button>
                </div><!-- /.box-footer -->
              </form>
          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

          
     </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- MD5 -->
    <script src="plugins/md5/jquery.md5.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>

    <script type="text/javascript">
        $(function() {            

            $(".customer-name").html(param["customerName"]);            

            $(".search").click(function(){
                if($.trim($("#password").val()) == ""){
                    $(".password-group").addClass("has-error");
                    $(".password-error").show();
                    $("#password").focus();
                    return false;
                }     
                if($.trim($("#confirm_password").val()) == ""){
                    $(".confirm-password-group").addClass("has-error");
                    $(".confirm-password-error").show();
                    $("#confirm_password").focus();
                    return false;
                }   
                if($("#password").val() != $("#confirm_password").val()){
                    $(".confirm-password-group").addClass("has-error");
                    $(".confirm-password-error").show();
                    $("#confirm_password").focus();
                    return false;                 
                }   

                var data = {
                    userName : param['email'],
                    userId: param['id'],
                    Password: $.md5($("#confirm_password").val())
                }

                $('.loader').show();

                jQuery.ajax({
                    url: SERVICE_URL + 'GlCustomCustomer/SetPasswordForUser',
                    method: "POST",    
                    contentType: 'application/json',   
                    data: JSON.stringify(data),                    
                    beforeSend: function (xhr) {
                       xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                    },
                    error: function(xhr, status, error) {
                        return false;
                    },
                    success: function(data) {
                       if(data['status'] == "1"){
                          localStorage.setItem("email", param['email']);
                          localStorage.setItem("customerName", param['customerName']);
                          localStorage.setItem("customerId", param['id']);
                          location.href = "home.html"
                       }
                       else{
                          alert("Failed");
                       }
                       $('.loader').hide();
                    }
               });


            });
            
            $('#password').on('keyup blur change', function(e) {
                $(".password-group").removeClass("has-error");
                $(".password-error").hide();
            });
            $('#confirm_password').on('keyup blur change', function(e) {
                $(".confirm-password-group").removeClass("has-error");
                $(".confirm-password-error").hide();
            });
        });
    </script>
  </body>
</html>
