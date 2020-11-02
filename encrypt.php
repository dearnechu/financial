<?php
  session_start();
  
  $GnuPG = new gnupg();
  $PublicData = "-----BEGIN PGP PUBLIC KEY BLOCK-----
Version: BCPG v1.60

mQENBF98CywBCACa9bWCxR3Sx3ZzptX+5HIo/w/apERjqba/JISlMer7Q4jpPEbd
sU2GekDxBIz6iY2cve2rHMErv5yWIFD4MYiYZJjrB5FrXPvESyTvYy1RF6+02lhn
M2Cm+I1oQidEHVnszeAeSll0fABpWTI53Q4hiQK5hT6d7y6wXB3RXIEj+0mgYfyc
XblIdnpr/TUjsxWkbqH6Bv1L4gsqaKLWLaNkkrilGt2YGDpVkHTYEvI+porWojC3
jZ91Q0Qn+0P0nZduMyr+0ABQV1COIpU4GG/gZ+22LZw5W4DS/3e6D8R8t7Xl3eQy
6FLCgsfV3oigcG2w1NYZkxFcMDuKwtlUeTxXABEBAAG0CEF4aXNCYW5riQEcBBAB
AgAGBQJffAssAAoJEPvS+s9E+rVDKukH/2qtRD0YAvWnK2yaAox4AjynzDLtMgNP
dAK+eMfO2fCAoXgYvsaGMP3MpLqsNquZDn1CG1THUP9ENL4+hrH5V6lpiOOAZwn0
wPB8lRYYN4fhBGspd7CFiykdZac9ukiyTxnfVVn9YEzkZGjafbShsLHb6wKW1zxm
jM+ULOAfNW+4ACWMQa3NJ6+lWXOPxtoIJTXrzLTglBaz6KvEunTg4SunkJxvyNti
nXMwb/7YvWO8VayvS+3nEl8CNeGfRMWZZo0Tk+4joKeAJMZj6R9Glw9kDXJRbxJS
2dsmJnZOaZ/FYOt4+7QjwgZb7DPaC8ridQRlmEKX7JSiZlfiSiqGLes=
=L7L0
-----END PGP PUBLIC KEY BLOCK-----";
  $PublicKey = $GnuPG->import($PublicData);
  $GnuPG->addencryptkey($PublicKey['fingerprint']);

  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['API_VERSION'] = '1';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_CODE'] = 'MUTHOOTML';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CMPY_CODE'] = '029010100347068';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_CRNCY'] = 'INR';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_PAYMODE'] = 'PA';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CUST_UNIQ_REF'] = date('YmdHis'); // 'SBK0820A0006723';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_TYPE'] = 'VEND';

  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TXN_AMOUNT'] = $_SESSION['loanAmount'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_ACC_NUM'] = '919020052207397';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_IFSC_CODE'] = 'UTIB0000784';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ORIG_USERID'] = 'DEMOCORP18';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['USER_DEPARTMENT'] = 'PAYMENT';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['TRANSMISSION_DATE'] = date('d-m-Y H-i-s'); // '21-09-2020 18-41-09';

  
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['VALUE_DATE'] = date('d-m-Y'); // '21-09-2020';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_CODE'] = $_SESSION['GetGoldLoanDetailsWeb']['customerCode']; // '6946';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_NAME'] = $_SESSION['GetBankDetailsByCustomerId']['accountHolder'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ACC_NUM'] = $_SESSION['GetBankDetailsByCustomerId']['accountNumber'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_IFSC_CODE'] = $_SESSION['GetBankDetailsByCustomerId']['ifscCode']; //'SBIN0008494';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_AC_TYPE'] = 'SB';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_BANK_NAME'] = $_SESSION['GetBankDetailsByCustomerId']['bank']['description']; // 'Basix';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BASE_CODE'] = 'DEMOCORP';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['PRODUCT_CODE'] = 'pa';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BATCH_ID'] = '671c6d56-86b8-4bfd-bb96-1a599caab713';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_EMAIL_ADDR'] = 'support@muthootenterprises.com';
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_MOBILE_NO'] = $_SESSION['customer_phone'];
  $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_EMAIL_ADDR1'] = $_SESSION['customer_email'];
  
  $jsondata = json_encode($payment_array);
  $enc = $GnuPG->encrypt($jsondata);
  echo $enc;

?>