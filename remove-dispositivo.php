<?php
require_once("templates/cabecalho.php");
require_once("controller/logica-usuario.php");

$id = $_POST['id'];
$dispositivoDao = new DispositivoDao($conexao);
$dispositivoDao->removeDispositivo($id);
$_SESSION["success"] = "Dispositivo removido com sucesso.";
header("Location: dispositivo-lista.php");
die();

?>