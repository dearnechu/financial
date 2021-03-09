<?php
	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$url = "https://sms.xpresssms.in/api/api.php?ver=1&mode=1&action=push_sms&type=1";
		$url .= "&route=2&login_name=muthootmercantile&api_password=f38ad42506766914d5d7&";
		$url .= "message=".str_replace(" ", "%20", $input_array['message']).".%20"; 
		$url .= "Email:%20".$input_array['email']."%20";
		$url .= "Password:%20".$input_array['password'];
		$url .= ".%20MUTHOOT%20MERCANTILE%20LTD";
		$url .= "&number=".$input_array['mobile']."&sender=MUTHOT";
		$url .= "&template_id=".$input_array['template_id'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
	}
?>