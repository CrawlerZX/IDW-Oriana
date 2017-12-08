<?php

	
	function carregaClasse($nomeDaClasse){
			require_once("class/".$nomeDaClasse.".php");
	}
	spl_autoload_register("carregaClasse");	
	
	error_reporting(E_ALL ^ E_NOTICE);
	
	require_once("controller/mostra-alerta.php");
	require_once("models/conecta.php");
	
?>  
	<html>
		<head>
			<meta charset="utf-8">
			<title>Oriana</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="templates/css/loja.css">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.5.0/js/jquery.terminal.min.js"></script>
			<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.5.0/css/jquery.terminal.min.css" rel="stylesheet"/>
		</head>
		<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">					
					<a class="navbar-brand" href="index.php">Oriana</a>
				</div>
				<div>
					<ul class="nav navbar-nav navbar-left">
						<li><a href="dispositivo-lista.php">Dispositivos</a></li>
						<li><a href="criptografia.php">Criptografar Mensagem</a></li>
					</ul>
				</div>
			</div>
		</nav>					
			<div class="container">
				<div class="principal">
					<?php mostraAlerta("success"); ?>
					<?php mostraAlerta("danger"); ?>