<?php
	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$url = "http://sapteleservices.com/SMS_API/sendsms.php?username=muthootgroup&password=muthoot12345&sendername=MUTHOT&routetype=1";

		$url .= "&message=".str_replace(" ", "%20", $input_array['message']); 
		if ($input_array['email']) {
			$url .= ".%20Email:%20".$input_array['email']."%20";	
		}
		if ($input_array['password']) {
			$url .= "Password:%20".$input_array['password'];
		}
		$url .= ".%20MUTHOOT%20MERCANTILE%20LTD";
		$url .= "&mobile=".$input_array['mobile'];
		$url .= "&template_id=".$input_array['template_id'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
	}
?>