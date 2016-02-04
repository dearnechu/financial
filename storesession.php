<?php
	session_start();
	$input = file_get_contents('php://input');
	if($input){
		$input_array = json_decode($input, true);
		$_SESSION[$input_array['tag']] = $input_array['data'];
	}
?>