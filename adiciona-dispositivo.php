<?php
	require_once("templates/cabecalho.php");
	require_once("controller/logica-usuario.php");


	verificaUsuario();
	$dispositivo = new Dispositivo($_POST);

	if($_POST['ativo'] == 1) {
	    $dispositivo->setAtivo(1);
	} else {
	    $dispositivo->setAtivo(0);
	}
	
	$dispositivoDao = new DispositivoDao($conexao);	
	if($dispositivoDao->insereDispositivo($dispositivo)) { 
		$_SESSION["success"] = "O dispositivo Modelo:  {$dispositivo->getModelo()}, IP: {$dispositivo->getIp()} foi adicionado.";
		header("Location: dispositivo-lista.php");
	} else {
		$msg = mysqli_error($conexao);
	?>
		<p class="text-danger">O dispositivo <?= $dispositivo->getModelo() ?> não foi adicionado: <?= $msg?></p>
	<?php
	}
	?>

<?php include("templates/rodape.php"); ?>
