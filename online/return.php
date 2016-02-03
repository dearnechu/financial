<?php
error_reporting(0);
session_start();
$_SESSION['status'] = false;
$SECURE_SECRET = "154E0E8E5C53404CDB5CF31C7EA9BD1D";//Add your secure secret 

$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
unset($_GET["vpc_SecureHash"]); 

if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {
    $SHA256HashData = $SECURE_SECRET;
    ksort ($_GET);
    foreach($_GET as $key => $value) {
        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
            $SHA256HashData .= $value;
        }
    }
    if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash("sha256",$SHA256HashData,false))) {
        $_SESSION['status'] = true;
    } 
} 


$ch = curl_init();
$accesstoken = "ZYHWiOqBYiHORTVkmNarVeTrYHTLfp38";


$jsondata = '{
   "loanId": "ead70454-620b-4186-9190-ba8ca266bd8b",
  "branchId": "FD1CBA65-1B68-449F-8E6D-A652137466D4",
  "companyId": "918FCC58-499E-4757-912A-295DC19BE564",
  "date": "2016-02-01T08:51:55.494Z",
  "loanInterest": 3018,
  "loanAmount": 30000,
  "totalAmount": 33018, 
  "isCompletelyPaid": true,
  "isMinimumLoanAmountPaid": false,
  "isGlClose": true,
  "transactionDate": "2016-02-01T08:51:55.494Z",
  "financialYearId": "36B2EEA0-89E2-4B2F-B767-E8F04203E4A4",
  "journalDate": "2016-02-01T08:51:55.494Z",
  "paymentStatus": "Success"
}';

curl_setopt($ch, CURLOPT_URL,"https://muthootlive.azure-mobile.net/api/PgCustomGoldLoan/CloseGoldLoan");curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, ":$accesstoken");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"postvar1=$postvar");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata ); 
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json')); 


$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
//print_r($server_output);
$output = json_decode($server_output);


// further processing ....
if ($server_output == "OK") { echo "Ok"; } else { print_r($output->message);  }

curl_close ($ch);

header("Location: home.html");

function null2unknown($data) {
    if ($data == "") {
        return "No Value Returned";
    } else {
        return $data;
    }
} 
?>
