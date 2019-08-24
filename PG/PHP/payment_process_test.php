<?php
session_start();
$_SESSION['http://localhost/PG/PHP/form.html'] = $_SERVER['REQUEST_URI'];

$stamp = date("Ymdhis");
$ip = $_SERVER['REMOTE_ADDR'];
$orderid = "123";
$orderid = str_replace(".", "", "$orderid");
//echo "///////</br> /////////".$orderid;

$billing_address_last_name=$_POST['billing_address_last_name'];
$_SESSION['billing_address_last_name']=$billing_address_last_name;

$customer_email = $_POST['customer_email'];
$_SESSION['customer_email']=$customer_email;

$customer_phone = $_POST['customer_phone'];
$_SESSION['customer_phone']=$customer_phone;

$description = $_POST['description'];
$_SESSION['description']=$description;

$amount = $_POST['amount'];
$_SESSION['custamount']=$amount;

 $billing_address_first_name = $_POST['billing_address_first_name'];
$_SESSION['billing_address_first_name']=$billing_address_first_name;

//$accountno = $_POST['accountno'];
//$_SESSION['accountno']=$accountno;

//$billing_address_line1 = $_POST['billing_address_line1'];
//$_SESSION['billing_address_line1']=$billing_address_line1;

//$billing_address_city = $_POST['billing_address_city'];
//$_SESSION['billing_address_city']=$billing_address_city;


curl_post($params,$method='POST');

function curl_post($params,$method)		
	{
$params['order_id'] = $stamp = date("Ymdhis");
$params['amount']= $_POST['amount'];
$params['billing_address_last_name'] = $billing_address_last_name;
$params['customer_phone'] = $customer_phone;
$params['customer_email'] = $customer_email;
$params['return_url'] = "http://localhost/PG/PHP/handleResponse.php";
$params['description'] = "Sample description";
$params['billing_address_first_name'] = $billing_address_first_name;
// $params['billing_address_city'] = $billing_address_city;
// $params['billing_address_line1'] = "Wadia Centre";
// $params['billing_address_line2'] = "Fourth Floor";
// $params['billing_address_line3'] = "Worli";
// $params['billing_address_city'] = "Mumbai";
// $params['billing_address_state'] = "Maharashtra";
// $params['billing_address_country'] = "India";
// $params['billing_address_postal_code'] = "400064";
// $params['billing_address_phone'] = "986743210";
// $params['billing_address_country_code_iso'] = "IND";
// $params['shipping_address_first_name'] = "Test";
// $params['shipping_address_last_name'] = "Technologies";
// $params['shipping_address_line1'] = "Wadia Centre";
// $params['shipping_address_line2'] = "Fourth Floor";
// $params['shipping_address_line3'] = "Worli";
// $params['shipping_address_city'] = "Mumbai";
// $params['shipping_address_state'] = "Maharashtra";
// $params['shipping_address_postal_code'] = "400064";
// $params['shipping_address_phone'] = "986743210";
// $params['shipping_address_country_code_iso'] = "IND";
// $params['shipping_address_country'] = "India";
$mg_api='218E2D2311A445EA5380C6787035FE';
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
//print_r($result);
 $someArray = json_decode($result, true); 
//print_r($someArray);
$weburl=$someArray['payment_links']['web'];
header('Location:'.$weburl);

 
exit;
}

?>