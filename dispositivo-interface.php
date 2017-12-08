<?php
	session_start();
/*
* Arquivo onde seria feita a integração SSH
*/
	require_once("templates/cabecalho.php");
	require_once("controller/logica-usuario.php");
	
	//$conexão = new componeteSSH($_POST['hostname'], $_POST['user'], $_POST['password'], $_POST['port']);
	//$conexão = new componenteSSH("192.168.15.4", "osboxes", "osboxes.org", 22);

	//var_dump($conexão->cmd("ls"));
?>
<div class="row">
    <div id="term">
    
    </div>
</div>
<script type="text/javascript">
	$(function() {		
	    $('#term').terminal(function(command, term) {
	        term.pause();
	        configu = '<?= $_POST['hostname']?>';
	        $.post('controller/ajax.php', {command: command, config: configu}).then(function(response) {
	        	response = jQuery.parseJSON(response);
	            term.echo(response[1]).resume();
	        });
	    }, {
	        greetings: 'Conexão com host: <?= $_POST['hostname']?>',
	        onBlur: function() {
	            return false;
	        },
	        height: "400px"
	    });
	});
</script>

<?php include("templates/rodape.php"); ?>