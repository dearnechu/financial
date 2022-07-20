<?php
	ini_set("session.cookie_httponly", 1);
	ini_set('session.cookie_secure', 1);
	session_start();
    header('Content-Type: application/json; charset=utf-8');
    include('config.php'); 
	include('mysql-pdo.php');
	$_SESSION['timestamp'] = strtotime(date("YmdHis")); 
	$db_conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
	$session_token = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

	// Logout
	if ($_REQUEST['url'] == 'logout') { 
		$sql = "DELETE FROM user_authentication WHERE user_id = '". json_decode($_POST['data'])->user_id ."' AND token = '". $_SESSION['session_token'] ."'";
		$db_conn->query($sql);
		session_destroy();
		exit;
	}
	// Authentication - logined User
	if (substr_compare($_REQUEST['url'], 'PgCustomGoldLoan/', 0) > 0) {
		$user_id =  json_decode($_POST['data'])->userId;
		if(!$user_id) {
			$user_id =  json_decode($_POST['data'])->customerId;
		}

		if (checkUserAuthentication($user_id, $_SESSION['session_token'], $db_servername, $db_database, $db_username, $db_password) == 0) {
			exit;
		}
	}

	$captcha_check = array(
		"GlCustomCustomer/GetCustomerDetails",
		"GlCustomCustomer/UserRegister",
		"GlCustomCustomer/ResetPassword"
	);

	if (in_array($_REQUEST['url'], $captcha_check)) {
		if(json_decode($_POST['data'])->captcha != $_SESSION['digit']) {
			die('{"message":"Incorrect CAPTCHA"}');
		}
	}

    $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $API_URL . $_REQUEST['url']);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, ":$accesstoken");
	if ($_POST['data']) {
		foreach (json_decode($_POST['data']) as $key => $value) {
			if (strlen($key) > 15 || strlen($value) > 45) {
				die('{"message":"Unauthorized Access"}');
			}
		}
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST['data'] ); 
	}
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
	} // Login with Failure
	else if ($_REQUEST['url'] == 'GlCustomCustomer/GetCustomerDetails' && !isset($data->data->id)) {

		if(isset($_SESSION['invalid-attempt-count'])) {
			$_SESSION['invalid-attempt-count'] += 1;
		} else {
			$_SESSION['invalid-attempt-count'] = 1;
		}  

		if(isset($_SESSION['invalid-attempt-timestamp']) && (strtotime(date("YmdHis")) - $_SESSION['invalid-attempt-timestamp'] >= 60)) { 
			$_SESSION['invalid-attempt-count'] = 1;
			$_SESSION['invalid-attempt-timestamp'] = strtotime(date("YmdHis")); 
		}

		if($_SESSION['invalid-attempt-count'] >= 3) {
			$_SESSION['invalid-attempt-timestamp'] = strtotime(date("YmdHis")); 
			die('{"message": "You have 3 unsuccessful attempt, Please try again later "}');
		}

		die('{"message":"Unauthorized Access"}');
	}
	echo $server_output;
?>