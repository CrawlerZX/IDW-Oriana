<?php
	require_once("templates/cabecalho.php");
	require_once("controller/logica-usuario.php");
	?>

	
	<h1>Bem vindo!</h1>

	<?php
	if(usuarioEstaLogado()) {
	?>	
		<img src="templates/images/Logo-Orriana.png" class="img-responsive center" >
		<p class="text-success">Você está logado como <?= usuarioLogado() ?>. <a href="controller/logout.php">Deslogar</a></p>		
	<?php	
	} else {
	?>		
		<h2>Login</h2>
		<form action="controller/login.php" method="post">
			<table class="table">
				<tr>
					<td>Email</td>
					<td><input class="form-control" type="email" name="email"></td>
				</tr>
				<tr>
					<td>Senha</td>
					<td><input class="form-control" type="password" name="senha"></td>
				</tr>
				<tr>
					<td><button class="btn btn-primary">Login</button></td>
				</tr>
			</table>
		</form>
	<?php
	}
	?>	

	<?php include("templates/rodape.php"); ?>
