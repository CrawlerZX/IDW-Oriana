<?php 
	require_once ("../models/banco-usuario.php");
	require_once("logica-usuario.php");
	
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	      
	$usuario = buscaUsuario($conexao, $email, $senha);
	
	if($usuario == null) {
		$_SESSION["danger"] = "Usuário ou senha inválido.";		
		header("Location: ../index.php");
	} else {
		$_SESSION["success"] = "Usuário logado com sucesso.";
		logaUsuario($usuario["email"]);
		header("Location: ../index.php");
	}
	die();