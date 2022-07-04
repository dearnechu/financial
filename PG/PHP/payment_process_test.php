<?php
session_start();
$_SESSION['http://localhost/PG/PHP/form.html'] = $_SERVER['REQUEST_URI'];

$stamp = date("Ymdhis");
$ip = $_SERVER['REMOTE_ADDR'];

$customer_email = $_POST['customer_email'];
$_SESSION['customer_email']=$customer_email;

$customer_phone = $_POST['customer_phone'];
$_SESSION['customer_phone']=$customer_phone;

$description = $_POST['description'];
$_SESSION['description']=$description;

$amount = $_POST['amount'];
$_SESSION['custamount']=$amount;

// $billing_address_last_name=$_POST['billing_address_last_name'];
// $_SESSION['billing_address_last_name']=$billing_address_last_name;

// $billing_address_first_name = $_POST['billing_address_first_name'];
// $_SESSION['billing_address_first_name']=$billing_address_first_name;

if($_SESSION['custamount'] < $_SESSION['payment']['minimumInterestToBePaid']) {
	$_SESSION['status'] = false;
	header("Location: /home.html");
	exit;
}
if($_SESSION['payment_type'] == "FULL" && $_SESSION['custamount'] < $_SESSION['payment']['fullPaymentTotal']) { 
	$_SESSION['status'] = false;
	header("Location: /home.html");
	exit;
}

curl_post($method='POST');

function curl_post($method) {
	$params['order_id'] = $stamp = date("Ymdhis");
	$params['amount']= $_POST['amount'];
	$params['customer_phone'] = $_POST['customer_phone'];
	$params['customer_email'] = $_POST['customer_email'];
	$params['customer_id'] = $_POST['customerId'];
	// $params['return_url'] = "http://localhost/financial/response.php";
	$params['return_url'] = "https://muthootone.muthootenterprises.com/response.php";
	$params['description'] =  $_POST['description'];
	$params['billing_address_last_name'] = '';
	$params['billing_address_first_name'] = '';
	$params['payment_method_type'] = 'CARD`';

	$params['shipping_address_country_code_iso'] = "IND";
	$params['shipping_address_country'] = "India";
	$mg_api='2C36B07E11249D58CC0E2A72C51C3C'; // for MMLT Account
	if ($_SESSION['payment']['companyId'] === '918FCC58-499E-4757-912A-295DC19BE564') {
		$mg_api='F89F22EAF024F79BEFE32EABE6CE2A'; // for MSNL Account
	}
	$curl_post_url = "https://axisbank.juspay.in/orders";
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_VERBOSE, 0);
	curl_setopt ($ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($ch, CURLOPT_USERPWD, $mg_api . ":");
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_HEADER, false);
	curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt ($ch, CURLOPT_URL, $curl_post_url);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 0);
	$result = curl_exec($ch);
	curl_close($ch);
	//$res = json_decode($payment_links,'web',TRUE);
	//return $res;
	// print_r($result);
	$someArray = json_decode($result, true); 
	//print_r($someArray);
	$weburl = $someArray['payment_links']['web'];
	header('Location:'.$weburl);
	exit;
}

?>