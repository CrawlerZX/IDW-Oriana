<?php
	require_once("conecta.php");

	function buscaUsuario($conexao, $email, $senha) {


		$senhaMd5 = md5($senha);
		$email = mysqli_real_escape_string($conexao, $email);
		$query = "select * from users where email='{$email}' and password='{$senhaMd5}'";
		$query = "SELECT * FROM users WHERE password = '{$senhaMd5}' and email = '{$email}'";
		$resultado = mysqli_query($conexao, $query);
		$usuario = mysqli_fetch_assoc($resultado);

		return $usuario;
	}
	
	
	