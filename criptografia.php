<?php
	require_once("templates/cabecalho.php");
	require_once("controller/logica-usuario.php");

	verificaUsuario();	
?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#first-tab" data-toggle="tab">Criptografar</a></li>
	<li><a href="#second-tab" data-toggle="tab">Descriptografar</a></li>
</ul>
 
<div class="tab-content">
	<div class="tab-pane active in" id="first-tab">
		<div class="row">
		    <div class="cols-md-4">
		    	<h2>Criptografar Texto</h2>
		    	<form method="post" action="" id="ajax_form">
		    		<table class="table">
						<tr>
							<td>Texto a ser criptografado</td>
							<td><textarea class="form-control" type="text-area" required="true" name="message"></textarea></td>
						</tr>
						<tr>
							<td>Chave 256 de bits</td>
							<td>
								<input class="form-control" type="text" id="key" required="true" name="key">
								<small>A chave pode estar encodada com base64, para facilitar visualização</small>
							</td>
							<td><button type="button" id="newKey" class="btn btn-primary">Gerar chave aleatória</button></td>
						</tr>
						<tr>
							<td><button type="submit"  class="btn btn-primary">Criptografar</button></td>
						</tr>
					</table>
		    	</form>
		    	<div class="cols-md-4">
		    		<label>Resultado criptografado</label>
					<textarea id="resultado" class="form-control" readonly="true"></textarea>
					<small>
						Atenção: Após criptografado o resultado retornado está encodado com base64 para facilitar visualização.
					</small>
				</div>		
		    </div>
		</div>
	</div>
	<div class="tab-pane" id="second-tab">
		<div class="row">
		    <div class="cols-md-4">
		    	<h2>Descriptografar Texto</h2>
		    	<form method="post" action="" id="ajax_form2">
		    		<table class="table">
						<tr>
							<td>Texto a ser descriptografado</td>
							<td><textarea class="form-control" type="text-area" required="true" name="message"></textarea></td>
						</tr>
						<tr>
							<td>Chave 256 de bits</td>
							<td>
								<input class="form-control" type="text" id="key" required="true" name="key">
								<small>A chave deve estar encodada com base64, para facilitar visualização</small>
							</td>
							<td><div id="space"></div></td>
						</tr>
						<tr>
							<td><button type="submit"  class="btn btn-primary">Descriptografar</button></td>
						</tr>
					</table>
		    	</form>
		    	<div class="cols-md-4">
		    		<label>Resultado</label>
					<textarea id="retorno" class="form-control" readonly="true"></textarea>
				</div>		
		    </div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#newKey').click(function(){
			var dados = "newKey=1";
			jQuery.ajax({
				type: "POST",
				url: "controller/criptografar.php",
				data: dados,
				success: function( data )
				{
					$('#key').val(data);
				}
			});
			
			return false;
		});
	});	
	jQuery(document).ready(function(){
		jQuery('#ajax_form').submit(function(){
			var dados = jQuery( this ).serialize();
			jQuery.ajax({
				type: "POST",
				url: "controller/criptografar.php",
				data: dados,
				success: function(data)
				{
					$('#resultado').val(data);
				}
			});
			
			return false;
		});
	});
	jQuery(document).ready(function(){
		jQuery('#ajax_form2').submit(function(){
			var dados = jQuery( this ).serialize();
			jQuery.ajax({
				type: "POST",
				url: "controller/descriptografar.php",
				data: dados,
				success: function(data)
				{
					$('#retorno').val(data);
				}
			});
			
			return false;
		});
	});
</script>
<?php include("templates/rodape.php"); ?>