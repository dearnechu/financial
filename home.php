<?php
  ini_set("session.cookie_httponly", 1);
  ini_set('session.cookie_secure', 1);
  session_start();
  session_regenerate_id();
?>
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
            <li class="treeview active">
              <a href="home.html">
                <i class="fa fa-credit-card"></i> <span>Online Payment</span><i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Registration Form</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li> -->
            <li class="treeview">
              <a href="online-gold.html">
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

      <div class="content-wrapper">     
        <!-- Main content -->
        <section class="content">

          <?php 
            if(isset($_SESSION['status'])) {
              $success = array(
                  "class" => "success",
                  "header" => "Success",
                  "message" => "Your payment has been successfully processed. Thank you."
                );
              $failure = array(
                  "class" => "danger",
                  "header" => "Failure",
                  "message" => "Sorry, we could not able to process your payment."
                );
              
              $status = ($_SESSION['status'] == "true" ? $success : $failure);
              unset($_SESSION['status']);
          ?>

            <div class="pad margin pg-message">
              <div class="callout callout-<?php echo $status['class']; ?>" style="margin-bottom: 0!important;">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4><?php echo $status['header']; ?></h4>
                <?php echo $status['message']; ?>
              </div>
            </div>
          <?php
            }
          ?>

          <div class="row">
            <div class="col-xs-12">
              <div class="box mainBox">
                <div class="box-body ">
                  <table id="LoanTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Loan Account No</th>
                        <th>Disbursement Date</th>
                        <th>Loan Amount</th>
                        <th>Last Repayment Date</th>
                        <th>Scheme Name</th>
                        <th>Statement</th>
                      </tr>
                    </thead>
                   </table>
                </div><!-- /.box-body -->
                <div class="overlay spinner-search"><i class="fa fa-spinner fa-spin"></i></div>
              </div><!-- /.box -->       

              <!-- Statement of Account box -->
              <div class="box loanStatements" style="display:none">
                <div class="box-header" align="center">
                  <h3 class="box-title removeHeader">Statement of Account</h3>             
                  <div class="box-tools pull-right removeHeader">
                    <button class="btn btn-box-tool" title="Print" onclick="PrintElem('.loanStatements')"><i class="fa fa-print"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                  <div class="box-header" align="center">
                    <h3 class="box-title">Muthoot Mercantile Limited</h3> <br/>
                    <h3 class="box-title">Branch Name : <span id="branch_name"></span> , Branch Code : <span id="branch_code"></span></h3>
                  </div>
                </div>
                
                <div class="col-lg-12 col-xs-12">
                  <div class="box">
                    <div class="box-body no-padding">
                      <table class="table table-condensed">
                        <tr>
                          <td style="width: 12%"><b>Name</b></td>
                          <td style="width: 55%" id="name"></td>
                          <td style="width: 15%"><b>Pledge No</b></td>
                          <td style="width: 15%" id="pledge_no"></td>
                        </tr>
                        <tr>
                          <td><b>Address</b></td>
                          <td id="address"></td>
                          <td><b>Pledge Date</b></td>
                          <td id="pledge_date"></td>
                        </tr>
                        <tr>
                          <td><b>Description</b></td>
                          <td id="description"></td>
                          <td><b>Pledge Value</b></td>
                          <td id="pledge_value"></td>
                        </tr>
                        <tr>
                          <td><b>Scheme Name</b></td>
                          <td id="scheme_name"></td>
                          <td><b>Net Weight</b></td>
                          <td id="net_weight"></td>
                        </tr>
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- ./col -->

                <div class="col-lg-12 col-xs-12">
                  <div class="box" style="border-top:none">
                    <div class="box-header" align="center">
                     <h3 class="box-title pull-center">Statement of Account</h3>
                      <div class="box-tools pull-right">
                          <h4 class="box-title" id="current_date"></h4>
                      </div>                  
                    </div>

                    <table id="StatementTable" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Debit</th>
                          <th>Credit</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>

                <div class="box-footer clearfix">
                  <div class="col-sm-12 text-red">
                    
                  </div>
                </div>

              </div><!-- /.Statement of Account box -->

              
              <!-- Payment Details box -->
              <div style="display:none" class="box loanDetails">
                <div class="box-header" align="center">
                  <h3 class="box-title">Payment Details - <span id="loan_number"></span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">
                      <h4 class="box-title">Full Settlement</h4>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-condensed">
                         <tr>
                          <td>Principle Amount</td>
                          <td id="principle_amount"></td>
                        </tr>
                        <tr class="DPNPrinciple" style="display:none">
                          <td>DPN Principle Remaining</td>
                          <td id="dpn_principle_remaining"></td>
                        </tr>
                        <tr  class="DPNInterest" style="display:none">
                          <td>DPN Interest Due</td>
                          <td id="dpn_interest_due"></td>
                        </tr>
                        <tr>
                          <td>Interest</td>
                          <td id="interest"></td>
                        </tr>
                        <!-- <tr>
                          <td>Payment Type</td>
                          <td>
                          <div class="form-group">
                            <div class="col-md-6">
                              <input type="radio" name="ftype" class="flat-red FullPType" value="PG" checked> Debit Card
                            </div>
                            <div class="col-md-6">
                              <input type="radio" name="ftype" class="flat-red FullPType" value="NB"> Net Banking
                            </div>
                          </td>
                          </div>
                        </tr> -->
                        <tr class="FPGSCharge">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="service_charge"></td>
                        </tr>
                        <tr class="FNBSCharge" style="display:none">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="net_service_charge"></td>
                        </tr>
                        <tr class="FPGTotal">
                          <td><b>Total</b></td>
                          <td id="pgtotal"><b></b></td>
                        </tr>
                        <tr class="FNBTotal" style="display:none">
                          <td><b>Total</b></td>
                          <td id="nbtotal"><b></b></td>
                        </tr>
                      </table>
                    </div><!-- /.box-body -->
                    <div class="overlay fullpayment"><i class="fa fa-spinner fa-spin"></i></div>
                    <div class="box-footer">
                      <button class="btn btn-success pull-right" id="FullPayment"><i class="fa fa-credit-card"></i> Full Payment</button>
                    </div><!-- /.box-footer -->
                  </div><!-- /.box -->
                </div><!-- ./col -->

                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">
                      <h4 class="box-title">Part Payment</h4>  
                      <i>(amount between <b> <span id="minimum_interest_amount"> </span> - <span id="total_payable_amount" > </span></b>)</i>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-condensed">
                        <tr>
                          <td>Enter Amount</td>
                          <td>
                            <input type="number" id="PartAmount" class="form-control input-sm"/>
                            <label style="margin-bottom: 0px;">&nbsp;</label>
                            <label class="text-red part-payment-error" style="display:none; margin-bottom:0px"> Invalid amount </label>
                          </td>
                        </tr>
                        <!-- <tr>
                          <td>Payment Type</td>
                          <td>
                          <div class="form-group">
                            <div class="col-md-6">
                              <input type="radio" name="ptype" class="flat-red PartPType" value="PG" checked> Debit Card
                            </div>
                            <div class="col-md-6">
                              <input type="radio" name="ptype" class="flat-red PartPType" value="NB"> Net Banking
                            </div>
                          </td>
                          </div>
                        </tr> -->
                        <tr class="PPGSCharge">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="part_service_charge">0.00</td>
                        </tr>
                        <tr class="PNBSCharge" style="display:none">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="part_net_service_charge"></td>
                        </tr>
                        <tr class="PPGTotal">
                          <td><b>Total</b></td>
                          <td id="PG_part_total"><b>0.00</b></td>
                        </tr>
                        <tr class="PNBTotal" style="display:none">
                          <td><b>Total</b></td>
                          <td id="NB_part_total"><b>0.00</b></td>
                        </tr>
                        <tr class="DPNPrinciple" style="display:none">
                          <td>&nbsp;</td>
                          <td></td>
                        </tr>
                        <tr  class="DPNInterest" style="display:none">
                          <td>&nbsp;</td>
                          <td></td>
                        </tr>
                      </table>
                    </div><!-- /.box-body -->
                    <div class="overlay partpayment"><i class="fa fa-spinner fa-spin"></i></div>
                    <div class="box-footer">
                      <button class="btn btn-success pull-right" id="PartPayment"><i class="fa fa-credit-card"></i> Part Payment</button>
                    </div><!-- /.box-footer -->
                  </div><!-- /.box -->
                </div><!-- ./col -->

                <div class="box-footer clearfix">
                  
                </div>

              </div><!-- /.Payment Details box -->

               <!-- EMI Details box -->
              <div style="display:none" class="box emiDetails">
                <div class="box-header" align="center">
                  <h3 class="box-title">EMI Payment of - <span id="emi_number"></span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-body no-padding">
                      <table class="table table-condensed">
                        <tr>
                          <td>Premium Amount</td>
                          <td id="emiMonthlyInstallment"></td>
                        </tr>
                        <tr>
                          <td>Paid / Total Installments</td>
                          <td id="noOfInstallments"></td>
                        </tr>                       
                        <tr>
                          <td>Pay Installments</td>
                          <td><select class="form-control input-sm" style="width:100px" id="payInstallments"></select></td>
                        </tr>
                        <tr>
                          <td>Penalty</td>
                          <td id="penalty">0.00</td>
                        </tr>  
                        <tr>
                          <td>Discount</td>
                          <td id="discount">0.00</td>
                        </tr>  
                        <!-- <tr>
                          <td>Payment Type</td>
                          <td>
                          <div class="form-group">
                            <div class="col-md-6">
                              <input type="radio" name="etype" class="flat-red EMIType" value="PG" checked> Debit Card
                            </div>
                            <div class="col-md-6">
                              <input type="radio" name="etype" class="flat-red EMIType" value="NB"> Net Banking
                            </div>
                          </td>
                          </div>
                        </tr> -->
                        <tr class="EMIPGSCharge">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="EmiServiceCharge"></td>
                        </tr>
                        <tr class="EMINBSCharge" style="display:none">
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0% for below 2000, otherwise 0.8% + GST (18% of service charge)"></i></a></td>
                          <td id="EmiServiceCharge"></td>
                        </tr>
                        <tr class="EMIPGTotal">
                          <td><b>Total</b></td>
                          <td id="emipgtotal"><b></b></td>
                        </tr>
                        <tr class="EMINBTotal" style="display:none">
                          <td><b>Total</b></td>
                          <td id="eminbtotal"><b></b></td>
                        </tr>
                      </table>
                    </div><!-- /.box-body -->
                    <div class="overlay emipayment"><i class="fa fa-spinner fa-spin"></i></div>
                    <div class="box-footer">
                      <button class="btn btn-success pull-right" id="EmiPayment"><i class="fa fa-credit-card"></i> Payment</button>
                    </div><!-- /.box-footer -->
                  </div><!-- /.box -->
                </div><!-- ./col -->

                <div class="box-footer clearfix">
                  
                </div>

              </div><!-- /.EMI Details box -->


          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Note</h4>
            </div>
            <div class="modal-body">
              Please do not close the window until shows the transaction success message.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="transactionContinue">Continue</button>
            </div>
          </div>
        </div>
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
    <form id="PG" method="post" action="PG/PHP/payment_process_test.php">
      <input type="hidden" name="amount" id="vpc_Amount">
      <input type="hidden" name="customer_phone" id="customer_phone">
      <input type="hidden" name="customer_email" id="customer_email">
      <input type="hidden" name="customerId" id="customerId">
      <input type="hidden" name="description" id="vpc_MerchTxnRef">
      <!-- 
        <form id="PG" method="post" action="PG/Axis/PHP_VPC_3Party_Order_DO.php">
        <input type="hidden" name="vpc_ReturnURL" value="http://localhost/PG/Axis/PHP_VPC_3Party_Order_DR.php">
      -->
    </form>

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
    <script src="plugins/js/config.js?rand=20220707"></script>
    <!-- Formatting Date -->
    <script src="plugins/dateformat/format.js"></script>
     <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- Home -->
    <script src="plugins/js/home.js?rand=2022070601"></script>
    <?php
      include('session.php');
    ?>
  </body>
</html>
