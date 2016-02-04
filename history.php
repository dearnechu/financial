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
     <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
   
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
                <i class="fa fa-download"></i> <span>Download Pawn Ticket</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-history"></i> <span>Payment History</span><i class="fa fa-angle-right pull-right"></i>
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

          <div class="row">
            <div class="col-xs-12">
              <div class="box mainBox">
                <div class="box-body ">
                  <table id="LoanTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Transaction No</th>   
                        <th>Loan No</th>
                        <th>Amount Paid</th>
                        <th>Payment Date</th>
                        <th>Payment Status</th>
                      </tr>
                    </thead>
                   </table>
                </div><!-- /.box-body -->
                <div class="overlay spinner-search"><i class="fa fa-spinner fa-spin"></i></div>
              </div><!-- /.box -->       
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div>
      
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
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
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

        $(function() {
            history(null, null);
        });

    function history(startDate, endDate) {
        var fromDate = moment().subtract(29, 'days');
        if(startDate != null){
            fromDate = startDate;
        }

        var toDate = moment();
        if(endDate != null){
            toDate = endDate;
        }

        var person = {
            userId: localStorage.getItem("customerId"),
            currentIndex: 0,
            pageSize: 20,
            fromDate: fromDate.toISOString(),  
            toDate: toDate.toISOString(),
            //userId: "9E3A0B3B-8ABB-4C64-A13A-A7AAF30472EC"
        }

        jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/GetPaymentHistoryByCustomerId',
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
                for(var index in data['data']['glPaymentHistoryDto']) { 
                    var Amount = 0;
                    if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanAmount')){
                        Amount = data['data']['glPaymentHistoryDto'][index]['loanAmount'];
                    }
                    Amount += data['data']['glPaymentHistoryDto'][index]['loanInterest'];

                    dataSet.push([
                        data['data']['glPaymentHistoryDto'][index]['id'], 
                        data['data']['glPaymentHistoryDto'][index]['loanNumber'],
                        Amount.format(2, 3),
                        new Date(data['data']['glPaymentHistoryDto'][index]['transationDate']).format("d-M-Y"), 
                        "Success"
                    ]);
                }
                pageCount = 10;
                
                //$("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Payment History </label>");
                
                      $('#LoanTable').DataTable( {
                          "destroy": true,
                          "pageLength" : pageCount,
                          "data": dataSet,
                          "paging": dataSet.length > pageCount,
                          "lengthChange": false,
                          "searching": true,
                          "ordering": false,
                          "info": dataSet.length > pageCount,
                          "autoWidth": false,
                      });     
                      

                      $("#LoanTable_wrapper .row .col-sm-6:first-child").append('<button class="btn btn-default" id="daterange-btn">' +
                        '<i class="fa fa-calendar"></i> Date Range ' +
                        '&nbsp;<i class="fa fa-caret-down"></i>' +
                      '</button>');  

                      //Date range as a button
                      $('#daterange-btn').daterangepicker({
                        ranges: {
                          'Today': [moment(), moment()],
                          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                          'This Month': [moment().startOf('month'), moment().endOf('month')],
                          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: fromDate,
                        endDate: toDate,
                        maxDate: moment(),
                        showDropdowns: true,
                        dateLimit: {
                            months: 6
                        }, 
                      },
                      function (start, end) {
                        //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        $('.spinner-search').show();
                        history(start, end);
                      }
                  );                
                  $('.spinner-search').hide();
            }
       });
      
    }; 
    </script>
  </body>
</html>
