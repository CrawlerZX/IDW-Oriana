<?php
// require_once("ambiente.php");
require_once("templates/cabecalho.php");


$id = $_POST['id_dispositivo'];
$dispositivoDao = new DispositivoDao($conexao);
$dispositivo = $dispositivoDao->buscaDispositivo($id);

?>

<h1>Alterando dispositivo</h1>
<form action="altera-dispositivo.php" method="post">
	<input type="hidden" name="id" value="<?=$dispositivo->getId()?>">
	<table class="table">
		<?php include("dispositivo-formulario-base.php"); ?>
		<tr>
			<td>
				<button class="btn btn-primary" type="submit">Alterar</button>
			</td>
		</tr>
	</table>
</form>

<?php include("templates/rodape.php"); ?>
