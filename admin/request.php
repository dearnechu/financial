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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
     <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
   
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style type="text/css">
        .sorting_desc::after{
            display: none !important;
        }
        .sorting_desc{
            cursor: text !important;
        }
    </style>

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
              <a href="index.html">
                <i class="fa fa-credit-card"></i> <span>Dashboard</span><i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-history"></i> <span>Request History</span><i class="fa fa-angle-right pull-right"></i>
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
                        <th class="no-sort">Name</th>   
                        <th class="no-sort">Mobile</th>
                        <th class="no-sort">Pincode</th>
                        <th class="no-sort">Requested Date</th>
                        <th class="no-sort">Status</th>
                        <th class="no-sort">Details</th>
                      </tr>
                    </thead>
                   </table>
                </div><!-- /.box-body -->
                <div class="overlay spinner-search"><i class="fa fa-spinner fa-spin"></i></div>
              </div><!-- /.box -->       


             <!-- Statement of Account box -->
              <div class="box loanStatements" style="display:none">
                <div class="box-header" align="center">
                  <h3 class="box-title removeHeader">Request Details</h3>             
                  <div class="box-tools pull-right removeHeader">
                    <button class="btn btn-box-tool" title="Print" onclick="PrintElem('.loanStatements')"><i class="fa fa-print"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                
                <div class="col-lg-12 col-xs-12">
                  <div class="box">
                    <div class="box-body no-padding">
                      <table class="table table-condensed">
                        <tr>
                          <td style="width: 12%"><b>Name</b></td>
                          <td style="width: 25%" id="name"></td>
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

                <div class="box-footer clearfix">
                  
                </div>

              </div><!-- /.Statement of Account box -->



          </div><!-- /.row -->

        </section><!-- /.content -->
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.2.0
        </div>
        <strong>Copyright &copy; 2010 <a target="_blank" href="http://www.muthootenterprises.com/">Muthoot Mercantile Limited</a>.
      </footer>      
      
       <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Config and Common -->
    <script src="../plugins/js/config.js"></script>
    <!-- Formatting Date -->
    <script src="../plugins/dateformat/format.js"></script>
    <!-- History -->
    <script src="../plugins/js/request.js"></script>


  </body>
</html>
