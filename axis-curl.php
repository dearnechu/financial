<!DOCTYPE html>
<html>
  <?php
    $ch = curl_init();
    $url = 'https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/muthootml/Pay';
  
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERNAME, "corpuser");
    curl_setopt($ch, CURLOPT_USERPWD, "axiscorpcon1!");
    curl_setopt($ch, CURLOPT_POST, 1);

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['API_VERSION'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_CODE'] = 'DEMOCORP133';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CMPY_CODE'] = '029010100347068';
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

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CHEQUE_NUMBER'] = '0';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CHEQUE_DATE'] = [];
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['PAYABLE_LOCATION'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['PRINT_LOCATION'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['PRODUCT_CODE'] = 'test@axisbank.com';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BATCH_ID'] = '97';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ADDR_1'] = 'arun nagar,Pimpalgaon,Pimpalgaon Bk.,Jalgaon,Pachora,Maharashtra,424203,';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ADDR_2'] = 'test';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_ADDR_3'] = '';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_CITY'] = 'Jalgaon';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_STATE'] = 'Maharashtra';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_PINCODE'] = '424203';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['CORP_EMAIL_ADDR'] = 'test@axisbank.com';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_EMAIL_ADDR1'] = 'test@axisbank.com';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_EMAIL_ADDR2'] = 'test@axisbank.com';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['BENE_MOBILE_NO'] = '9895933511';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ENRICHMENT1'] = 'test1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ENRICHMENT2'] = 'test1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ENRICHMENT3'] = 'test1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ENRICHMENT4'] = 'test1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['ENRICHMENT5'] = 'test1';    
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['PAYMENTS']['STATUS_ID'] = '1';    

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['INVOICE_NUMBER'] = 'INVOICE122';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['INVOICE_DATE'] = '2020-08-04';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['NET_AMOUNT'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['TAX'] = '0';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['CASH_DISCOUNT'] = '0';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][0]['INVOICE_AMOUNT'] = '1';

    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['INVOICE_NUMBER'] = 'INVOICE122';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['INVOICE_DATE'] = '2020-08-04';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['NET_AMOUNT'] = '1';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['TAX'] = '0';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['CASH_DISCOUNT'] = '0';
    $payment_array['RECORD']['PAYMENT_DETAILS'][0]['INVOICE'][1]['INVOICE_AMOUNT'] = '1';

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
