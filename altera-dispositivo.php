<?php
	require_once("templates/cabecalho.php");

	$dispositivo = new Dispositivo($_POST);
	$dispositivo->setId($_POST['id']);
	if($_POST['ativo'] == 1) {
	    $dispositivo->setAtivo(1);
	} else {
	    $dispositivo->setAtivo(0);
	}

	$dispositivoDao = new DispositivoDao($conexao);

	if($dispositivoDao->alteraDispositivo($dispositivo)) { 
		$_SESSION["success"] = "O dispositivo Modelo:  {$dispositivo->getModelo()}, IP: {$dispositivo->getIp()} foi alterado.";
		header("Location: dispositivo-lista.php");
	} else {
		$msg = mysqli_error($conexao);
	?>
		<p class="text-danger">O dispositivo Modelo: <?= $dispositivo->getModelo() ?>, IP: <?= $dispositivo->getIp() ?> não foi alterado: <?= $msg?></p>
	<?php
	}
	?>

<?php include("templates/rodape.php"); ?>
