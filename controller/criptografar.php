<?php
	require_once("../class/CriptografiaAES.php");

	$criptografiaAES = new CriptografiaAES;

	//gera chave de 256 bits, e encoda com base 64
	if(isset($_POST['newKey'])){

		$resultado = base64_encode(openssl_random_pseudo_bytes(32));
		unset($_POST['newKey']);
		echo ($resultado);
	}
	
	//criptografa mensagem
	if(isset($_POST['message']) && isset($_POST['key'])){
			$message = $_POST['message'];
			$key     = base64_decode($_POST['key']);
			unset($_POST['message']);
			unset($_POST['key']);
			if(mb_strlen($key, '8bit') !== 32){
				echo("É necessário uma chave de 256 bits");
			}else{
				echo(base64_encode($criptografiaAES->encrypt($message, $key)));
			}
	}
	