<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MuthootOne | Loans</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Config and Common -->
    <script src="plugins/js/config.js"></script>
     <!-- Home -->
    <!-- <script src="plugins/js/axis.js?rand=1992"></script> -->

  </body>

  <?php
    $ch = curl_init();
    $url = 'https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/muthootml/Pay';
  
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERNAME, "corpuser");
    curl_setopt($ch, CURLOPT_USERPWD, "axiscorpcon1!");
    curl_setopt($ch, CURLOPT_POST, 1);

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['API_VERSION'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_CODE'] = 'DEMOCORP115';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CMPY_CODE'] = 'DEMOCORP';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_CRNCY'] = 'INR';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_PAYMODE'] = 'IMPS';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CUST_UNIQ_REF'] = 'SBK0820A0003197';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_TYPE'] = 'VEND';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_AMOUNT'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_ACC_NUM'] = '675010100002387';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_IFSC_CODE'] = 'AXIS789087';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ORIG_USERID'] = 'DEMOCORP18';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['USER_DEPARTMENT'] = 'PAYMENT';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TRANSMISSION_DATE'] = '04-08-2020 21-09-09';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_CODE'] = '6946';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['VALUE_DATE'] = '04-08-2020';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['RUN_IDENTIFICATION'] = 'SBK0820A0003197_6946';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['FILE_NAME'] = 'SBK0820A0003197_6946';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_NAME'] = 'HBGHJM';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ACC_NUM'] = '54657486456';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_IFSC_CODE'] = 'SBIN0008494';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_AC_TYPE'] = 'SB';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_BANK_NAME'] = 'Basix';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BASE_CODE'] = 'DEMOCORP';

    $jsondata = json_encode($payment_array);
    print_r($jsondata);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata ); 
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json')); 

    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);

    print_r($server_output);
    
    curl_close ($ch);

  ?>
</html>
