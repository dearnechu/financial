<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Loans</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="assets/images/favicon.png" rel="shortcut icon">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>One</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Muthoot</b>One</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">      
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu pull-left">
                <a>
                  <span>Welcome <b><span class="customer-name"></span></b></span>
                </a>
              </li>     
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle logout">                  
                  <span>Logout <i class="fa fa-fw fa-power-off"></i></span>
                </a>
              </li>              
            </ul>
          </div>
        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">GOLD LOAN</li>
            <li class="treeview">
              <a href="home.html">
                <i class="fa fa-credit-card"></i> <span>Online Payment</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Registration Form</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-sun-o"></i> <span>Online Gold Loan</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-print"></i> <span>Print Pawn Ticket</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="history.html">
                <i class="fa fa-history"></i> <span>Payment History</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-exchange"></i> <span>Change Password</span><i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
           <li class="treeview">
              <a href="support.html">
                <i class="fa fa-support"></i> <span>Support</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
           <!-- <li class="treeview">
              <a href="faq.html">
                <i class="fa fa-sliders"></i> <span>FAQ</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li> -->

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper">     
        <!-- Main content -->
        <section class="content">

        <div class="login-box box" style="width:440px">
          <div class="login-box-body">
            <div class="box-header" align="center" style="padding-top:0px">
              <h3 class="box-title"> Change Password </h3>
            </div>
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="Password" class="col-sm-5 control-label">Current Password</label>
                      <div class="col-sm-7 current-password-group">
                        <input type="password" class="form-control" id="current_password" placeholder="Current Password">
                        <label class="control-label current-password-error" for="current_password" style="display:none"><i class="fa fa-times-circle-o"></i> Please provide password</label>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="Password" class="col-sm-5 control-label">New Password</label>
                      <div class="col-sm-7 password-group">
                        <input type="password" class="form-control" id="password" placeholder="New Password">
                        <label class="control-label password-error" for="password" style="display:none"><i class="fa fa-times-circle-o"></i> Please provide password</label>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="Confirm Password" class="col-sm-5 control-label">Confirm Password</label>
                    <div class="col-sm-7 confirm-password-group">
                      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                      <label class="control-label confirm-password-error" for="confirm password" style="display:none"><i class="fa fa-times-circle-o"></i> password mismatch</label>
                    </div>      
                  </div>    
                </div><!-- /.box-body -->
                 <p class="login-box-msg error-message" style="display:none"></p>
                <div class="box-footer">
                  <button type="button" id="Change" class="btn btn-info pull-right search">Submit
                    <i class="fa fa-spinner fa-spin loader" style="display:none"></i>
                  </button>
                </div><!-- /.box-footer -->
              </form>
          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->


          </div><!-- /.row -->

        </section><!-- /.content -->
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2010 <a target="_blank" href="http://www.muthootenterprises.com/">Muthoot Mercantile Limited</a>. Powered by <a target="_blank" href="http://www.experionglobal.com/">Experion Technologies</a></strong>.
      </footer>

      
       <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- MD5 -->
    <script src="plugins/md5/jquery.md5.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <!-- Formatting Date -->
    <script src="plugins/dateformat/format.js"></script>
    


    <script type="text/javascript">
        $( "#Change" ).click(function() {            
            if($.trim($("#current_password").val()) == ""){
                $(".current-password-group").addClass("has-error");
                $(".current-password-error").show();
                $("#current_password").focus();
                return false;
            }            
            if($.trim($("#password").val()) == ""){
                $(".password-group").addClass("has-error");
                $(".password-error").show();
                $("#password").focus();
                return false;
            }
            if($("#password").val() != $("#confirm_password").val()){
                $(".confirm-password-group").addClass("has-error");
                $(".confirm-password-error").show();
                $("#confirm_password").focus();
                return false;
            }     
            
            $(".loader").show();

            var data = {
                    customerId: localStorage.getItem("customerId"),
                    Password: $.md5($("#current_password").val()),
                    newPassword: $.md5($("#confirm_password").val())
                }

            jQuery.ajax({
                url: SERVICE_URL + 'GlCustomCustomer/ChangePassword',
                method: "POST",    
                contentType: 'application/json',   
                data: JSON.stringify(data),                    
                beforeSend: function (xhr) {
                   xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                },
                error: function(xhr, status, error) {
                    $(".error-message").addClass("text-red");
                    $(".error-message").html("Sorry, could not able to connect the server. Please try again later");
                    $(".error-message").show();
                    $(".loader").hide();
                },
                success: function(data) {
                   if(data['status'] == "1"){
                      $(".error-message").html("You have successfully changed your password");
                      $(".error-message").removeClass("text-red");
                      $(".error-message").addClass("text-green");
                      $(".error-message").show();
                      $(".loader").hide();
                      $(".form-control").val("");
                   }
                   else{
                      $(".error-message").addClass("text-red");
                      $(".error-message").removeClass("text-green");
                      $(".error-message").html("Sorry, Could not able to change your Password");
                      $(".error-message").show();
                      $(".loader").hide();
                   }
                }
           });
                
        });

        $('#current_password').on('keyup blur change', function(e) {
            $(".current-password-group").removeClass("has-error");
            $(".current-password-error").hide();
        });

        $('#password').on('keyup blur change', function(e) {
            $(".password-group").removeClass("has-error");
            $(".password-error").hide();
        });

        $('#confirm_password').on('keyup blur change', function(e) {
            $(".confirm-password-group").removeClass("has-error");
            $(".confirm-password-error").hide();
        });

 
    </script>
  </body>
</html>
