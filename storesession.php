<?php
	session_start();
	$input = $_POST;
	if($input){
		$_SESSION[$input['tag']] = $input['data'];
	}
?>
