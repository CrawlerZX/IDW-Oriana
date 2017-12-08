<?php
	//$conexao = mysqli_connect("mysql.hostinger.com.br", "u770729046_user", "u770729046_senha", "u770729046_codex");

	$conexao = mysqli_connect("localhost", "root", "", "codex");
	if (!$conexao) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}