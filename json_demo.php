<?php
	require_once("templates/cabecalho.php");
	require_once("controller/logica-usuario.php");

	verificaUsuario();
	$dispositivoDao = new DispositivoDao($conexao);
	$dispositivo = $dispositivoDao->buscaDispositivo($_POST['id_dispositivo']);	
?>
<div class="row">
    <div class="term2">
        <?php
			$connection = ssh2_connect('br-1.brssh.com', 22);

			ssh2_auth_password($connection, 'mrodrigues', 'mrodrigues');
			$stream = ssh2_exec($connection, '/usr/local/bin/php -i');
			var_dump($stream);
		?>

    </div>
    <div class="term">
        
    </div>
</div>
<script type="text/javascript">
</script>

<?php include("templates/rodape.php"); ?>
<script type="text/javascript">
	jQuery(function($) {
	    $('.term').terminal("json-rpc-service-demo.php", {
	        login: true,
	        greetings: "You are authenticated"});
	});
	$(function() {
    $('.term2').terminal(function(command, term) {
        return $.post('script.php', {command: command});
    }, {
        greetings: 'Simple php example',
        onBlur: function() {
            return false;
        }
    });
});
</script>
