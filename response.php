<?php 
	include "config.php";
	error_reporting(0);
	session_start();

	$orderId = $_GET["order_id"];
	$merchantId = "MMLT";
	$payment_array = $_SESSION['payment'];

	$ch = curl_init('https://axisbank.juspay.in/order_status');

	curl_setopt($ch, CURLOPT_POSTFIELDS ,array('orderId' => $orderId , 'merchantId' => $merchantId ));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	if ($payment_array['companyId'] === '918FCC58-499E-4757-912A-295DC19BE564') {
		curl_setopt($ch, CURLOPT_USERPWD, '51D764F4E42474E831E778DB82AC8F'); // MSNL
	} else {
		curl_setopt($ch, CURLOPT_USERPWD, '218E2D2311A445EA5380C6787035FE'); // MML
	}

	$jsonResponse =  json_decode( curl_exec($ch) ); 

	$statusId = $jsonResponse->{'statusId'};
	$amount = $jsonResponse->{'amount'};
	$txnId = $jsonResponse->{'txnId'};

	$payment_array["paymentStatus"] = "Failed";
	$payment_array["paidAmount"] = 0;
	$payment_array["transactionNumber"] = date("YmdHis");
	$payment_array['OnlineServiceCharge'] = 0;
	if($statusId == 21) {   
		$_SESSION['status'] = true;

		if($_SESSION['payment_type'] == "FULL"){
			$url = $API_URL . "PgCustomGoldLoan/CloseGoldLoan";
		}
		elseif($_SESSION['payment_type'] == "EMI"){
			$url = $API_URL . "PgCustomGoldLoan/AddEmiPayment";
			$payment_array["totalEmiPaid"] = $_SESSION['payInstallments'];
		}
		else{
			$url = $API_URL . "PgCustomGoldLoan/AddPartPayment";
		}
		
		$payment_array["paymentStatus"] = "Success";
		$payment_array["paidAmount"] = $amount - (double)$_SESSION['service_charge'];
		$payment_array["OnlineServiceCharge"] = (double)$_SESSION['service_charge'];
		$payment_array["transactionNumber"] = $txnId; 
		$payment_array["PaymentProcessType"] = 'AXIS PG';
	} 
	$jsondata = json_encode($payment_array);

	unset($_SESSION['payment']);
	unset($_SESSION['service_charge']);
	unset($_SESSION['payment_type']);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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