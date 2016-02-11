<?php
	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$url = "http://sms.xpresssms.in/api/api.php?ver=1&mode=1&action=push_sms&type=1&route=2&login_name=muthootmercantile&api_password=37d5822068b86f5c7316&message=You%20have%20registered%20Muthoot%20Online.%20Password:%20".$input_array['password']."&number=".$input_array['mobile']."&sender=mthoot";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
	}
?>