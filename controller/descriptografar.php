<?php
	require_once("../class/CriptografiaAES.php");

	$criptografiaAES = new CriptografiaAES;
	
	// descriptografa menssagem
	if(isset($_POST['message']) && isset($_POST['key'])){
			$message = base64_decode($_POST['message']);
			$key     = base64_decode($_POST['key']);
			unset($_POST['message']);
			unset($_POST['key']);
			echo $criptografiaAES->decrypt($message, $key);
	}