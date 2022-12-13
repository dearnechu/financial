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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- Custom CSS style -->
    <link rel="stylesheet" href="dist/css/custom.css">
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
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-sun-o"></i> <span>Online Gold Loan</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="pawn-ticket.html">
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
        <!-- Main content -->
        <section class="content">
          <h2 class="page-header">Online Gold Loan</h2>

          <div id="NoAccountBlock" class="callout callout-warning" style="display:none">
            <h4>You have not registered your bank account.</h4>
            <p>Please contact your branch for register the bank account.</p>
          </div>

          <div class="row" id="AccountBlock" style="display:none">
            <div class="col-lg-12 col-xs-12">
                  <div class="box">
                    <div class="box-body no-padding">
                      <table class="table">
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
                      </table>
                    </div>
                  </div>
            </div>
          </div><!-- /.row -->

          <div class="row" id="AccountListBlock" style="display:none">
            <div class="col-xs-12">
              <div class="box mainBox">
                <div class="box-body ">
                  <table id="LoanTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Loan Account No</th>
                        <th>Disbursement Date</th>
                        <th>Loan Amount</th>
                        <th>Available Loan Amount</th>
                        <th>Last Repayment Date</th>
                        <th>Scheme Name</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

              <!-- Payment Details box -->
              <div style="display:none" class="box loanDetails">
                <div class="box-header" align="center">
                  <h3 class="box-title">Apply Gold Loan for - <span id="loan_number"></span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-header">
                      <h4 class="box-title">You can apply for the Gold Loan</h4>  
                      <i>(amount between <b> <span id="minimum_amount_to_be_apply"> </span> - <span id="total_payable_amount" > </span></b>)</i>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-condensed">

                        <tr>
                          <td>Do you want to upgrade the existing scheme ? </td>
                          <td>
                                <label class="switch">
                                  <input type="checkbox" id="isSwitchPlan"> <span class="slider round"></span>
                                </label>
                          </td>
                        </tr>
                        
                        <tr class="schemeDetails" style="display:none">
                          <td>Select a scheme for topup </td>
                          <td>
                            <select class="form-control" id="TopupPlan"> 
                            </select>
                          </td>
                        </tr>
                        <tr class="schemeDetails" style="display:none">
                           <td> Minimum Interest Period of selected scheme</td>
                           <td id="minimumInterestPeriod"></td>
                        </tr>
                        <tr class="schemeDetails" style="display:none">
                           <td> Slab Rate of selected scheme </td>
                           <td id="currentSlabRate"></td>
                        </tr>
                        <tr class="schemeDetails" style="display:none">
                           <td> Available Loan Amount </td>
                           <td id="availLoan"></td>
                        </tr>

                        <tr>
                          <td>Enter Amount</td>
                          <td>
                            <input type="number" id="PartAmount" class="form-control input-sm"/>
                            <label style="margin-bottom: 0px;">&nbsp;</label>
                            <label class="text-red part-payment-error" style="display:none; margin-bottom:0px"> Invalid amount </label>
                          </td>
                        </tr>
                        <tr class="PPGSCharge">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="There is NO service charge for now"></i></a></td>
                          <td id="part_service_charge">0.00</td>
                        </tr>
                        <tr class="PPGTotal">
                          <td><b>Total Amount will Be Credited in Your Account</b></td>
                          <td id="PG_part_total"><b>0.00</b></td>
                        </tr>
                      </table>
                    </div><!-- /.box-body -->
                    <div class="overlay partpayment"><i class="fa fa-spinner fa-spin"></i></div>
                    <div class="box-footer">
                      <button class="btn btn-success pull-right" id="confirm">
                        <i class="fa fa-hand-o-right"></i> Apply
                      </button>
                    </div><!-- /.box-footer -->
                  </div><!-- /.box -->
                </div><!-- ./col -->

                <div class="box-footer clearfix">
                  
                </div>

              </div><!-- /.Payment Details box -->

            </div>
          </div>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                  Could you please verify the top-up amount ? top-up amount will be credited to your bank account with in 24 working hours.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="PartPayment">Confirm</button>
                </div>
              </div>
            </div>
          </div>


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
    <script src="plugins/js/online-gold.js?rand=2709"></script>
    <?php
      include('session.php');
    ?>
  </body>
</html>
