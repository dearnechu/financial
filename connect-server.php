<?php
	session_start();
    header('Content-Type: application/json; charset=utf-8');
    include('config.php'); 
	$db_conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
	$session_token = md5(Date("YmdHis"));

	// Logout
	if ($_REQUEST['url'] == 'logout') { 
		$sql = "DELETE FROM user_authentication WHERE user_id = '". json_decode($_POST['data'])->user_id ."' AND token = '". $_SESSION['session_token'] ."'";
		$db_conn->query($sql);
		session_destroy();
		exit;
	}

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
	$data = json_decode($server_output);

	// Forgot Password (Without Login)
    if ($_REQUEST['url'] == 'GlCustomCustomer/ResetPassword') {
		die('{"message":"We have sent an SMS to registered mobile with login details. If you are not registered for online transaction, please contact your branch."}');
    }
	// Login with success
	if ($_REQUEST['url'] == 'GlCustomCustomer/GetCustomerDetails' && isset($data->data->id)) { 
		$_SESSION['session_token'] = $session_token;
		$sql = "INSERT INTO user_authentication (user_id, token) VALUES ('". $data->data->id ."', '".$session_token."')";
		$db_conn->query($sql);
	}
	echo $server_output;
?>