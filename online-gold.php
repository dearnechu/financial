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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

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
                <i class="fa fa-credit-card"></i> <span>Online Payment</span><i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Registration Form</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-sun-o"></i> <span>Online Gold Loan</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-download"></i> <span>Download Pawn Ticket</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="history.html">
                <i class="fa fa-history"></i> <span>Payment History</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="change_password.html">
                <i class="fa fa-exchange"></i> <span>Change Password</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
           <li class="treeview">
              <a href="support.html">
                <i class="fa fa-support"></i> <span>Support</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
           <li class="treeview">
              <a href="faq.html">
                <i class="fa fa-sliders"></i> <span>FAQ</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <h2 class="page-header">Online Gold Loan</h2>

          <div id="NoAccountBlock" class="callout callout-warning" style="display:none">
            <h4>Yo have not registered your bank account.</h4>
            <p>Please contact your branch for register the bank account.</p>
          </div>

          <div class="row" id="AccountBlock" style="display:none">
            <div class="col-lg-12 col-xs-12">
                  <div class="box">
                    <div class="box-body no-padding">
                      <table class="table">
                        <tr>
                          <td><b>Available Gold Loan</b></td>
                          <td id=""><b>10, 000</b></td>
                        </tr>
                        <tr>
                          <td class="col-md-2"><b>Bank Name</b></td>
                          <td class="col-md-10" id="bankName"></td>
                        </tr>
                        <tr>
                          <td><b>Account Holder Name</b></td>
                          <td id="accountHolder"></td>
                        </tr>
                        <tr>
                          <td><b>Account Number</b></td>
                          <td> <span id="accountNumber"></span> <span class="text-muted"><i> (Loan amount will be credited to this account) </i></span></td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td><b>IFSC Code</b></td>
                          <td id="ifscCode"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><button class="btn btn-success" id="PartPayment"><i class=""></i> Apply for Loan</button></td>
                        </tr>
                      </table>
                    </div>
                  </div>
            </div>
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2010 <a target="_blank" href="http://www.muthootenterprises.com/">Muthoot Mercantile Limited</a>. Powered by <a target="_blank" href="http://www.experionglobal.com/">Experion Technologies</a></strong>.
      </footer>

       <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <script src="plugins/js/online-gold.js?rand=1992"></script>
  </body>
</html>
