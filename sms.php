<?php
	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$url = "http://sms.xpresssms.in/api/api.php?ver=1&mode=1&action=push_sms&type=1";
		$url .= "&route=4&login_name=muthootmercantile&api_password=37d5822068b86f5c7316&";
		$url .= "message=".str_replace(" ", "%20", $input_array['message']).".%20"; 
		$url .= "Email:%20".$input_array['email']."%20";
		$url .= "Password:%20".$input_array['password'];
		$url .= "&number=".$input_array['mobile']."&sender=MUTHOT";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
	}
?>