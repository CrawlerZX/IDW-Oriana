<?php
require_once("templates/cabecalho.php");
require_once("controller/logica-usuario.php");

verificaUsuario();

$dispositivo = new Dispositivo($_POST);
?>



<h1>Cadastrar Dispositivos</h1>
<form action="adiciona-dispositivo.php" method="post">
	<table class="table">

		<?php include("dispositivo-formulario-base.php"); ?>

		<tr>
			<td>
				<button class="btn btn-primary" type="submit">Cadastrar</button>
			</td>
		</tr>
	</table>
</form>

<?php include("templates/rodape.php"); ?>
