<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Loans</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <div class="wrapper" style="background-color: #ecf0f5">

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
              <a href="#">
                <i class="fa fa-credit-card"></i> <span>Online Payment</span><i class="fa fa-angle-right pull-right"></i>
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
                          <td><b>Locality</b></td>
                          <td id="locality"></td>
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
                        <tr>
                          <td>Interest</td>
                          <td id="interest"></td>
                        </tr>
                        <tr>
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0.75% for below 2000, otherwise 1%"></i></a></td>
                          <td id="service_charge"></td>
                        </tr>
                        <tr>
                          <td><b>Total</b></td>
                          <td id="total"><b></b></td>
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
                        <tr>
                          <td>Service Charge &nbsp; <a href="#"><i class="fa fa-question" data-toggle="tooltip" title="0.75% for below 2000, otherwise 1%"></i></a></td>
                          <td id="part_service_charge">0.00</td>
                        </tr>
                        <tr>
                          <td><b>Total</b></td>
                          <td id="part_total"><b>0.00</b></td>
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


          </div><!-- /.row -->

        </section><!-- /.content -->
      </div>
      
       <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <form id="PG" method="post" action="PG/PHP-cybs/2.5Party/EMA_php_serverhost_do_2.5.php">
      <input type="hidden" name="vpc_URL" value="https://uat-geniusepay.in/VisaEMA/Visa/merchant.action">
      <input type="hidden" name="vpc_Version" value="1">
      <input type="hidden" name="vpc_Command" value="pay">
      <input type="hidden" name="vpc_AccessCode" value="MYZY7094">
      <input type="hidden" name="vpc_MerchantId" value="TESTCAMUTHOOMER">
      <input type="hidden" name="vpc_OrderInfo" value="GOLD LOAN">    
      <input type="hidden" name="vpc_MerchTxnRef" id="vpc_MerchTxnRef">
      <input type="hidden" name="vpc_Amount" id="vpc_Amount">
      <input type="hidden" name="vpc_ReturnURL" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/return.html'; ?>">
    </form>

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
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <!-- Formatting Date -->
    <script src="plugins/dateformat/format.js"></script>
    


    <script type="text/javascript">
        Number.prototype.format = function(n, x) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
            return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
        };
        
        var minimumInterestToBePaid = 0;
        var total = 0;

        $(function() {
            var person = {
                userId: localStorage.getItem("customerId"),
                //userId: "9E3A0B3B-8ABB-4C64-A13A-A7AAF30472EC"
            }
            $("#PartAmount").val('');

            jQuery.ajax({
                url: SERVICE_URL + 'PgCustomGoldLoan/GetLoansByCustomerId',
                contentType: 'application/json',   
                method: "POST",
                data: JSON.stringify(person),
                beforeSend: function (xhr) {
                   xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                },
                error: function(xhr, status, error) {
                    return false;
                },
                success: function(data) {         
                    var dataSet = new Array();         
                    for(var index in data['data']) { 
                        dataSet.push([
                            "<a class='best' href='javascript:showLoanDetails("+ data['data'][index]['loanNumber'] +", \"" + data['data'][index]['branchId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>", 
                            new Date(data['data'][index]['startDate']).format("d-M-Y"), 
                            data['data'][index]['loanAmount'].format(2, 3), 
                            new Date(data['data'][index]['revisedDate']).format("d-M-Y"), 
                            data['data'][index]['glScheme']['schemeName'],
                            "<a href='javascript:showLoanStatements(\""+ data['data'][index]['id'] +"\")'> View </a>"
                        ]);
                    }
                    pageCount = 3;
                    if(index > 9){
                      pageCount = 5;
                    }
                    var table = $('#LoanTable').DataTable( {
                        "pageLength" : pageCount,
                        "data": dataSet,
                        "paging": dataSet.length > pageCount,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": false,
                        "info": dataSet.length > pageCount,
                        "autoWidth": false,
                    });     
                    $("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Online Payment </label><i> (Click over the loan account no for making payment) </i>");
                    $('.spinner-search').hide();   
                    
                    setTimeout(function() {  $(".pg-message").hide("slow");  }, 10000);   

                    $('#LoanTable tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('bg-gray') ) {
                            $(this).removeClass('bg-gray');
                        }
                        else {
                            table.$('tr.bg-gray').removeClass('bg-gray');
                            $(this).addClass('bg-gray');
                        }
                    });            
                }
            });
            
            $( "#FullPayment" ).click(function() { 
                $(".fullpayment").show();
                $("#vpc_MerchTxnRef").val("MGLFULL" + "-" + new Date().format("YmdHis") );
                $("#PG").submit();
            });

            var part_total = 0;
            $( "#PartPayment" ).click(function() { 
                if($.trim($("#PartAmount").val()) < minimumInterestToBePaid){
                    $("#PartAmount").focus();
                    $(".part-payment-error").show();
                    return false;;
                }   
                if($.trim($("#PartAmount").val()) > total){
                    $("#PartAmount").focus();
                    $(".part-payment-error").show();
                    return false;;
                }   
                $(".part-payment-error").hide();
                $(".partpayment").show();
                $("#vpc_Amount").val(part_total.toFixed(2) * 100);
                $("#vpc_MerchTxnRef").val("MGLPART" + "-" + new Date().format("YmdHis") );
                $("#PG").submit();
            });

            $(".close").click(function() {
                $(this).parent().parent().hide("slow");
            });

            $('#PartAmount').on('keyup blur change', function(e) {
                var service_charge = getServiceCharge($(this).val());
                $("#part_service_charge").html(service_charge.format(2,3));
                part_total = ($(this).val() * 1) + service_charge;
                $("#part_total").html(part_total.format(2,3));
                $(".part-payment-error").hide();
            });


        });

        function showLoanDetails(loanNo, branchId){ 
            $('.spinner-search').show();
            var data = {
                    loanNumber: loanNo,
                    branchId : branchId,
                    customerId: localStorage.getItem("customerId"),
                    logindate : new Date().toISOString()
                }
            
            jQuery.ajax({
                    url: SERVICE_URL + 'GlCustomLoan/GetGoldLoanDetailsWeb',
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
                      $(".mainBox").after($('.loanDetails'));
                      $('.loanDetails').show('slow');                    
                      if(data['status'] == "1"){
                        $("#loan_number").html(loanNo);
                        $("#principle_amount").html(data['data']['goldLoanAmountRemaining'].format(2, 3));
                        $("#interest").html(data['data']['goldLoanInterestDue'].format(2, 3));  
                        var service_charge = getServiceCharge(data['data']['goldLoanAmountRemaining'] + data['data']['goldLoanInterestDue']);
                        $("#service_charge").html(service_charge.format(2, 3));  
                        total = data['data']['goldLoanAmountRemaining'] + data['data']['goldLoanInterestDue'] + service_charge;
                        $("#vpc_Amount").val(total.toFixed(2) * 100);
                        $("#total").html("<b>" + total.format(2, 3) + "</b>");  
                        if(data['data'].hasOwnProperty('minimumInterestToBePaid')){
                            minimumInterestToBePaid = data['data']['minimumInterestToBePaid'];
                        }
                        $("#minimum_interest_amount").html(minimumInterestToBePaid.format(2, 3));  
                        $("#total_payable_amount").html(total.format(2,3));  
                        $('.spinner-search, .fullpayment, .partpayment').hide();
                      }
                    }
              });
        }

        function showLoanStatements(loanId){ 
            $('.spinner-search').show();
            var data = {
                    loanId: loanId,
                    //loanId: "3e32a621-183c-45f8-bc7c-f43f144cb181",
                }
            
            jQuery.ajax({
                    url: SERVICE_URL + 'PgCustomGoldLoan/GetPaymentHistoryByLoanId',
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
                      $('.appneded').remove();
                      $('.loanStatements').show('slow');     
                      
                       $(".mainBox").after($('.loanStatements'));

                      if(data['status'] == "1"){
                          $("#name").html(data['data']['glCustomerDto']['firstName']); 
                          if(data['data']['glCustomerDto'].hasOwnProperty('lastName')){
                              $("#name").html($("#name").html() + ' ' +  data['data']['glCustomerDto']['lastName']);
                          }
                          $("#address").html(data['data']['glCustomerDto']['addressOne']); 
                          $("#locality").html(data['data']['glCustomerDto']['locality']); 
                          $("#scheme_name").html(data['data']['glLoanDto']['glScheme']['schemeName']); 

                          $("#pledge_no").html(data['data']['glLoanDto']['loanNumber']); 
                          $("#pledge_date").html(new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y")); 
                          $("#pledge_value").html(data['data']['glLoanDto']['loanAmount'].format(2, 3)); 
                          $("#net_weight").html(data['data']['glLoanDto']['netWeight']); 

                          $("#branch_name").html(data['data']['glLoanDto']['branch']['name']); 
                          $("#branch_code").html(data['data']['glLoanDto']['branch']['code']); 

                          $("#current_date").html(new Date().format("d-M-Y h:i A"));

                          var Description = "AMOUNT PAID"; 
                          $('#StatementTable tr:last').after('<tr class="appneded">' +
                                  '<td>' + new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y") + '</td>' +
                                  '<td>' + Description + '</td>' +
                                  '<td>' + data['data']['glLoanDto']['loanAmount'].format(2, 3) + '</td>' +
                                  '<td></td>' +
                                  '<td>' + data['data']['glLoanDto']['loanAmount'].format(2, 3) + '</td>' +
                                  '</tr>');
                          var Description = "INTEREST TILL DATE - " + new Date().format("d-M-Y"); 
                          $('#StatementTable tr:last').after('<tr class="appneded">' +
                                  '<td>' + new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y") + '</td>' +
                                  '<td>' + Description + '</td>' +
                                  '<td>' + data['data']['glLoanDto']['interestTillDate'].format(2, 3) + '</td>' +
                                  '<td></td>' +
                                  '<td>' + (data['data']['glLoanDto']['loanAmount'] + data['data']['glLoanDto']['interestTillDate']).format(2, 3) + '</td>' +
                                  '</tr>');
                          var balanceAmount = data['data']['glLoanDto']['loanAmount'] + data['data']['glLoanDto']['interestTillDate'];
                          for(var index in data['data']['glPaymentHistoryDto']) { 

                                var loanAmount = 0;
                                if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanAmount')){
                                  loanAmount = data['data']['glPaymentHistoryDto'][index]['loanAmount'];
                                }

                                balanceAmount -= (loanAmount + data['data']['glPaymentHistoryDto'][index]['loanInterest']);

                                Description = "CASH RCVD - " + data['data']['glPaymentHistoryDto'][index]['id'];

                                /*
                                var balanceAmount = 0;
                                if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('balanceAmount')){
                                  balanceAmount = data['data']['glPaymentHistoryDto'][index]['balanceAmount'];
                                }
                                */
                                $('#StatementTable tr:last').after('<tr class="appneded">' +
                                  '<td>' + new Date(data['data']['glPaymentHistoryDto'][index]['transationDate']).format("d-M-Y") + '</td>' +
                                  '<td>' + Description + '</td>' +
                                  '<td></td>' +
                                  '<td>' + (loanAmount + data['data']['glPaymentHistoryDto'][index]['loanInterest']).format(2, 3) + '</td>' +
                                  '<td>' + balanceAmount.format(2, 3) + '</td>' +
                                  '</tr>');
                            
                          }
                      }
                      $('.spinner-search').hide();
                    }
              });

        }
    </script>
  </body>
</html>
