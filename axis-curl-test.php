<?php
  error_reporting(0);
  session_start();
  try {
      $gpg = new gnupg();
      // throw exception if error occurs

      $PublicData = file_get_contents('key/msnl_uat.pkr');
      $PublicKey = $gpg->import($PublicData);
      $gpg->seterrormode(gnupg::ERROR_EXCEPTION);
      $gpg->addencryptkey($PublicKey['fingerprint']);

      $gpg2 = new gnupg();
      $privateData = file_get_contents('key/private-muthoot.pkr');
      $privateKey = $gpg2->import($privateData);

      echo $privateKey['fingerprint'];
      $gpg->addsignkey($privateKey['fingerprint']);
      $cipher_text = $gpg->encryptsign('This is a test message');
      echo $cipher_text;
  } catch (Exception $e) {
      // restore the envelope
      echo "Failed";
      print_r($e);
      // re-throw the exception
  }

  exit;

  $GnuPG = new gnupg();
  $PublicData = file_get_contents('key/msnl_uat.pkr');
  $PublicKey = $GnuPG->import($PublicData);
  $GnuPG->addencryptkey($PublicKey['fingerprint']);
  

  if (!file_exists('logs/reverse/test/' . date('Ymd'))) {
      mkdir('logs/reverse/test/' . date('Ymd'), 0777, true);
  }
  $uneque_refrence_number = date('YmdHis');
  $fp = fopen('logs/reverse/test/' . date('Ymd') .'/'. $uneque_refrence_number . '.txt', 'w');

/*
  print_r($_SESSION['GetBankDetailsByCustomerId']);
  print_r($_SESSION['GetGoldLoanDetailsWeb']);
  
  echo "<br>-" . $_SESSION['customer_email'];
  echo "<br>-" .  $_SESSION['customer_phone'];
  echo "<br>-" .  $_SESSION['loanAmount'];
*/
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['API_VERSION'] = '1';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_CODE'] = 'DEMOCORP279';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CMPY_CODE'] = '029010100347068';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_CRNCY'] = 'INR';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_PAYMODE'] = 'PA'; // RT – RTGS  NE – NEFT   PA- IMPS   FT - Fund Transfer (Axis to Axis)
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CUST_UNIQ_REF'] = $uneque_refrence_number; // 'SBK0820A0006723';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_TYPE'] = 'VEND';

  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_AMOUNT'] = $_SESSION['loanAmount'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_ACC_NUM'] = '545010100111676';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_IFSC_CODE'] = 'UTIB0000784';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ORIG_USERID'] = 'DEMOCORP18';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['USER_DEPARTMENT'] = 'PAYMENT';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TRANSMISSION_DATE'] = date('d-m-Y H-i-s'); // '21-09-2020 18-41-09';

  
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['VALUE_DATE'] = date('d-m-Y'); // '21-09-2020';
  // $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['RUN_IDENTIFICATION'] = 'SBK0820A0003197_6946';
  // $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['FILE_NAME'] = 'SBK0820A0003197_6946';

  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_CODE'] = $_SESSION['GetGoldLoanDetailsWeb']['customerCode']; // '6946';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_NAME'] = $_SESSION['GetBankDetailsByCustomerId']['accountHolder']; // 'MUHAMMED NAZEEM'
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ACC_NUM'] = $_SESSION['GetBankDetailsByCustomerId']['accountNumber']; // '00000030046695019'
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_IFSC_CODE'] = $_SESSION['GetBankDetailsByCustomerId']['ifscCode']; //'SBIN0000861';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_AC_TYPE'] = 'SB';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_BANK_NAME'] = $_SESSION['GetBankDetailsByCustomerId']['bank']['code']; // 'SBI';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BASE_CODE'] = 'DEMOCORP';

  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['PRODUCT_CODE'] = 'pa';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BATCH_ID'] = 'MUTHOOT_MSNL';
  
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_EMAIL_ADDR'] = 'support@muthootenterprises.com';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_MOBILE_NO'] = $_SESSION['customer_phone'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_EMAIL_ADDR1'] = $_SESSION['customer_email'];
  

  $ch = curl_init('https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/Muthoot36/Pay');
  curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
  curl_setopt($ch, CURLOPT_PORT, 443);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_USERNAME, "corpuser");
  curl_setopt($ch, CURLOPT_USERPWD, "axiscorpcon1!");
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Cache-Control: no-cache'));
  
  $privateData = file_get_contents('key/private-muthoot.pkr');
  $privateKey = $GnuPG->import($privateData);

  fwrite($fp, PHP_EOL . 'Sign Status: ' . $GnuPG->addsignkey($privateKey['fingerprint']));
  $signed = $GnuPG->sign($jsondata);
  fwrite($fp, PHP_EOL . 'Signed: ' . $signed);

  $jsondata = json_encode($payment_array);
  fwrite($fp, PHP_EOL . 'JSON: ' . $jsondata);

  $enc = $GnuPG->encryptsign($jsondata);
  fwrite($fp, PHP_EOL . 'Enc: ' . $enc);
  
  curl_setopt($ch, CURLOPT_POSTFIELDS, $enc ); 
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/plain;charset=UTF-8')); 
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Basic Y29ycHVzZXI6YXhpc2NvcnBjb24xIQ==')); 
     
  $server_output = curl_exec($ch);
  $errors = curl_error($ch);
  $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);
  fwrite($fp, PHP_EOL . 'Server Output: ' . $server_output);
  fwrite($fp, PHP_EOL . 'Errors: ' . $errors);
  fwrite($fp, PHP_EOL . 'Response: ' . $response);


  //   {
  //     "Request": {
  //        "CORP_CODE": "DEMOCORP279",
  //        "PAY_DOC_NUMBER": [
  //           $uneque_refrence_number,
  //        ]
  //     }
  //  }

  $enq_array['Request']['CORP_CODE'] = 'DEMOCORP279';
  $enq_array['Request']['PAY_DOC_NUMBER'] = [$uneque_refrence_number];
  $jsondata = json_encode($enq_array);
  fwrite($fp, PHP_EOL . 'Enq req: ' . $jsondata);
  $enc = $GnuPG->encrypt($jsondata);
  fwrite($fp, PHP_EOL . 'Enc Enq: ' . $enc);

  $ch = curl_init('https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/Muthoot36/Pay/Enq');
  curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
  curl_setopt($ch, CURLOPT_PORT, 443);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_USERNAME, "corpuser");
  curl_setopt($ch, CURLOPT_USERPWD, "axiscorpcon1!");
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Cache-Control: no-cache'));

  curl_setopt($ch, CURLOPT_POSTFIELDS, $enc ); 
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/plain;charset=UTF-8')); 
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Basic Y29ycHVzZXI6YXhpc2NvcnBjb24xIQ==')); 

  $server_output = curl_exec($ch);
  $errors = curl_error($ch);
  $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);
  fwrite($fp, PHP_EOL . 'Enq Server Output: ' . $server_output);
  fwrite($fp, PHP_EOL . 'Enq Errors: ' . $errors);
  fwrite($fp, PHP_EOL . 'Enq Response: ' . $response);
  fclose($fp);
?>