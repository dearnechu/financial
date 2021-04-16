<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="getPrintData();">
    <div class="wrapper">
      <!-- Main content -->
       <!-- Main content -->
        <section class="invoice loanDetails">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <span id="companyName"></span>
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
                    <td style="border-top:none"><span class="loanAmount"></span></td>
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
              I, <strong id="customerName"></strong>, <span id="address"></span> hereby pawn my article this day <strong class="startDate"></strong> with M/s <strong>MUTHOOT MERCANTILE LTD</strong>, in the above branch of principal amount of <strong class="loanAmount"></strong> at annual interest rate as follows.
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>0-1 Months</th>
                    <th>2-3 Months</th>
                    <th>3-6 Months</th>
                    <th>Above 6 Months</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>12% (<strong>N</strong>)</td>
                    <td>18% (<strong>N</strong>)</td>
                    <td>22% (<strong>N</strong>)</td>
                    <td>24% (<strong>C</strong>) - Interest % from the Date of Pledge </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <strong>N</strong>-Simple <strong>C</strong>-Compound
                    </td>
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

        </section><!-- /.content -->
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
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
    <!-- Formatting Date -->
    <script src="plugins/dateformat/format.js"></script>
     <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- Home -->
    <script src="plugins/js/pawn.js?rand=2212"></script>
  </body>
</html>
