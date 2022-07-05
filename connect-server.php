<?php
    header('Content-Type: application/json; charset=utf-8');
    include('config.php'); 
 
    $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $API_URL . $_REQUEST['url']);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, ":$accesstoken");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST['data'] ); 
	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json')); 

	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec ($ch);

    if($_REQUEST['url'] == 'GlCustomCustomer/ResetPassword') {
        echo '{"message":"We have sent an SMS to registered mobile with login details. If you are not registered for online transaction, please contact your branch."}';
        exit;
    }
	echo $server_output;
?>