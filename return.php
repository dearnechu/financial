<?php
error_reporting(0);
session_start();

include "config.php";

$_SESSION['status'] = false;

$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
unset($_GET["vpc_SecureHash"]); 

$payment_array = $_SESSION['payment'];
$payment_array["paymentStatus"] = "Failed";
$payment_array["paidAmount"] = 0;
$payment_array["transactionNumber"] = date("YmdHis");
$payment_array['OnlineServiceCharge'] = 0;

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

        $url = $API_URL . "PgCustomGoldLoan/AddPartPayment";
        if($_SESSION['payment_type'] == "FULL"){
            $url = $API_URL . "PgCustomGoldLoan/CloseGoldLoan";
        }
        
        $payment_array["paymentStatus"] = "Success";
        $payment_array["paidAmount"] = $_GET["auth_amount"] - $_SESSION['service_charge'];
        $payment_array["OnlineServiceCharge"] = $_SESSION['service_charge'];
        $payment_array["transactionNumber"] = date("YmdHis");
    } 
} 

$jsondata = json_encode($payment_array);
unset($_SESSION['payment']);
unset($_SESSION['service_charge']);
unset($_SESSION['payment_type']);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, ":$accesstoken");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata ); 
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json')); 

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

header("Location: home.html");

?>
