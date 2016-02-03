<?php
	header('Content-type: application/json');
	require 'vendor/autoload.php';
	use Mailgun\Mailgun;

	$mg = new Mailgun("key-d5afe754b45838205a3aa84c0129686f");
	$domain = "sandbox33740f5288b849ec9e37ff50d2e8b95c.mailgun.org";

	$api_url = "http://staging.experionglobal.com/Muthoot/";
	$admin_email = "admin@muthootenterprises.com";

	$template = "templates/registration.html";
	$subject = "MuthootOne Online Portal Registration";	

	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$encrypt_string = base64_encode($input);

		$fd = fopen($template, "r");
		$mailcontent = fread($fd, filesize($template));
		
		$mailcontents = array(
							'name' => $input_array['customerName'],
							'api_url' => $api_url,
							'encrypt_string' => $encrypt_string
						);

	    foreach ($mailcontents as $key => $value) {
	        $mailcontent = str_replace("%%$key%%", $value, $mailcontent);
	    }
	    
	    $email = $input_array['email'];
    	$email = 'muhammed.nazeem@experionglobal.com';

    	# compose and send your message.
		$mg->sendMessage(	
			$domain, 
			array(	
				'from'    	=> $admin_email, 
                'to'      	=> $email, 
                'subject'	=> $subject, 
                'html' 		=> $mailcontent
            )
		);
	}