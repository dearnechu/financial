<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="1200" />
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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <style type="text/css">
      input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none;
          -moz-appearance: none;
          appearance: none;
          margin: 0; 
      }
      .emiDetails td{
          vertical-align: middle !important;
      }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red sidebar-mini">
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
            <li class="treeview">
              <a href="online-gold.html">
                <i class="fa fa-sun-o"></i> <span>Online Gold Loan</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-print"></i> <span>Print Pawn Ticket</span><i class="fa fa-angle-left pull-right"></i>
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
           <!-- <li class="treeview">
              <a href="faq.html">
                <i class="fa fa-sliders"></i> <span>FAQ</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li> -->

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <section class="invoice">
          <div class="row">
              <div class="col-xs-12">
                <div class="box mainBox" style="border-top:none">
                  <div class="box-body ">
                    <table id="LoanTable" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Loan Account No</th>
                          <th>Disbursement Date</th>
                          <th>Loan Amount</th>
                          <th>Last Repayment Date</th>
                          <th>Scheme Name</th>
                        </tr>
                      </thead>
                    </table>
                  </div><!-- /.box-body -->
                  <div class="overlay spinner-search"><i class="fa fa-spinner fa-spin"></i></div>
                </div><!-- /.box -->    
              <div>
          </div>
        </section>

        <!-- Main content -->
        <section class="invoice loanDetails" style="display:none">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool remove" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
              <h2 class="page-header">
                <span class="companyName"></span>
                <small>Pawn Ticket No: <span id="pawnTicketNumber"></span> (Digital Copy) </small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:15%; border-top:none">Pledge No:</th>
                    <td style="width:60%; border-top:none"><span id="loanNumber"></span></td>
                    <th style="border-top:none">Amount:</th>
                    <td style="border-top:none">Rs. <span class="loanAmount"></span></td>
                  </tr>
                  <tr>
                    <th>Branch:</th>
                    <td><span class="brancName"></td>
                    <th>Date:</th>
                    <td><span class="startDate"><span></td>
                  </tr>
                  <tr>
                    <th> </th>
                    <td> </td>
                    <th> </th>
                    <td> </td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->            
          </div><!-- /.row -->

           <div class="row">
            <div class="col-xs-12 table-responsive">
              I, <strong id="customerName"></strong>, <span id="address"></span> hereby pawn my article this day <strong class="startDate"></strong> with M/s <strong><span class="companyName"></span></strong>, in the above branch for a principal amount of Rs. <strong class="loanAmount"></strong> at an annual interest rate as follows.
              <table class="table table-striped">
                <thead>
                  <tr id="planHeading">
                  </tr>
                </thead>
                <tbody>                
                  <tr id="planBody"> 
                  </tr>
                  <tr id="planBottom">
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Table row -->
          <div class="row" style="margin-top: 10px;">
            <div class="col-xs-6 table-responsive">
              The details regarding articles are follows
              <table class="table">
                  <tr>
                    <th style="width:50%">Article:</th>
                    <td id="article"></td>
                  </tr>
                  <tr>
                    <th>Gross Weight:</th>
                    <td id="grossWeight"></td>
                  </tr>
                  <tr>
                    <th>Net Weight:</th>
                    <td id="netWeight"></td>
                  </tr>
                  <tr>
                    <th>Average Caratege:</th>
                    <td id="carat"></td>
                  </tr>
                </table>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="text-muted well well-sm no-shadow" style="margin-top: 50px;">
                I hereby promise to redeem the pawn after paying the principal amount and interest on or before the agreed redemption date <strong id="revisedDate">26th April 2021</strong>.
              </p>
            </div><!-- /.col -->
          </div><!-- /.row -->
          
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <p class="text-muted well well-sm no-shadow"><i>
                This is an automatic computer generated printout. It does not require a signature. The customer is directed to collect the original pawn ticket from the concerned branch at the earliest.
              </i></p>
            </div>
          </div>

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <a href="pawn-ticket-print.php" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a>
            </div>
          </div>
        </section><!-- /.content -->

        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2010 <a target="_blank" href="http://www.muthootenterprises.com/">Muthoot Mercantile Limited</a>. Powered by <a target="_blank" href="http://www.experionglobal.com/">Experion Technologies</a></strong>.
      </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 3.6.0 -->
    <script src="plugins/jQuery/jQuery-3.6.0.min.js"></script>
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
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <!-- Formatting Date -->
    <script src="plugins/dateformat/format.js"></script>
     <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- Home -->
    <script src="plugins/js/pawn.js?rand=2562"></script>
    <?php
      include('session.php');
    ?>
  </body>
</html>
