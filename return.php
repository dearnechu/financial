<?php
error_reporting(0);
session_start();
$_SESSION['status'] = false;
$SECURE_SECRET = "154E0E8E5C53404CDB5CF31C7EA9BD1D";//Add your secure secret 

$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
unset($_GET["vpc_SecureHash"]); 

$payment_array = $_SESSION['payment'];
$payment_array["paymentStatus"] = "Failed";
$payment_array["paidAmount"] = 0;
$payment_array["transactionNumber"] = date("YmdHis");

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
        $payment_array["paymentStatus"] = "Success";
        $payment_array["paidAmount"] = null2unknown($_GET["auth_amount"]);
        $payment_array["transactionNumber"] = date("YmdHis");
    } 
} 

$jsondata = json_encode($payment_array);
unset($_SESSION['payment']);

$ch = curl_init();
$accesstoken = "ZYHWiOqBYiHORTVkmNarVeTrYHTLfp38";

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
