<?php
require_once("templates/cabecalho.php");
require_once("controller/logica-listagem.php");
require_once("controller/logica-usuario.php");
verificaUsuario();
?>
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="modalLabel"><b>Atenção!</b></h3>
            </div>
            <div class="modal-body modalBody" id="messageDanger" style="background-color: rgba(0, 0, 0, 0.67);color: white;"></div>
            <div class="modal-footer" style="padding-bottom: 0;">
            	<form method="post" action="remove-dispositivo.php">
            		<input id="remDisp" type="hidden" name="id">
            		<button class="btn btn-danger" type="submit">Remover</button>
            		<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            	</form>            	     
            </div>
        </div>
    </div>
</div>

<div id="main" class="container-fluid">
    <div id="top" class="row">
	    <div class="col-md-3">
	        <h2>Dispositivos</h2>
	    </div>
	 	<div class="col-md-6">
	        <div class="input-group h2">
	            
	        </div>
	    </div>
	    <div id="addDisp" class="col-md-3">
	        <a href="dispositivo-formulario.php" class="btn btn-primary pull-right h2">Cadastrar Dispositivo</a>
	    </div>
	</div>
 
     
    <div id="list" class="row">
     	<div class="table-responsive col-md-12">
     		<table class="table table-inverse table-striped" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Hostname</th>
						<th>IP</th>
						<th>Tipo</th>
						<th>Fabricante</th>
						<th>Modelo</th>
						<th>Status</th>
						<th>Data de Cadastro</th>		
						<th colspan="2">Opções</th>
					<tr>	
				</thead>
				<tbody class="">
				<?php
				$dispositivoDao = new DispositivoDao($conexao);
				$pagina=$_GET['pagina'];
				if (!$pagina) {
					$pc = "1";
				} else {
					$pc = $pagina;
				}
				$dispositivos = $dispositivoDao->listaDispositivos($pc);
				$qtd_pag = $dispositivos['qtd'];
				$qtd_regs = $dispositivos['qtd_registros'];
				unset($dispositivos['qtd']);
				unset($dispositivos['qtd_registros']);

				//lista de dispositivos

				foreach($dispositivos as $dispositivo) :
					$messageDanger = "'<b>Você está prestes a remover permanentemente o dispositivo<br> Tipo {$dispositivo->getTipo()} Modelo {$dispositivo->getModelo()} cadastrado no dia {$dispositivo->getCreated_time()}</b>. <br><br><br> <b>Essa ação é irreversível, deseja continuar?</b><br>'";
				?>
					<tr>
						<th scope="row"><?= $dispositivo->getID() ?></th>
						<td><?= $dispositivo->getHostName() ?></td>
						<td><?= $dispositivo->getIp() ?></td>
						<td><?= $dispositivo->getTipo() ?></td>
						<td><?= $dispositivo->getFabricante() ?></td>
						<td><?= $dispositivo->getModelo() ?></td>
						<td><?php if($dispositivo->getAtivo()){echo "Ativo";} else {echo "Inativo";} ?></td>
						<td><?= $dispositivo->getCreated_time() ?></td>
						<td>
							<form action="dispositivo-interface.php" method="post">
								<input type="hidden" name="id_dispositivo" value="<?=$dispositivo->getId()?>">
								<input type="hidden" name="hostname" value="<?=$dispositivo->getHostName()?>">
								<input type="hidden" name="ip" value="<?=$dispositivo->getIp()?>">
								<button class="btn btn-success btn-xs">acessar</button>
							</form>
						</td>
						<td>
							<form action="dispositivo-altera-formulario.php" method="post">
								<input type="hidden" name="id_dispositivo" value="<?=$dispositivo->getId()?>">
								<button class="btn btn-warning btn-xs">alterar</button>
							</form>
						</td>
						<td>
							<a class="btn btn-danger btn-xs"  href="#" onclick="setID(<?=$dispositivo->getId() . "," . $messageDanger?>)" data-toggle="modal" data-target="#delete-modal">
							    remover
							</a>
						</td>
					</tr>
				<?php
				endforeach
				?>
				</tbody>	
			</table>
     	</div>     	    
    </div>

 	<?php
 	$class = checaPagina($pc, $qtd_pag);
 	?>
 	<div class="row"> 		
 		<small>Página <?=$pc?> - <?=$qtd_pag?></small>
 	</div>
 	<div class="row"> 		
 		<small>Total de <?=$qtd_regs?> dispositivos cadastrados</small>
 	</div> 	
    <div id="bottom" class="row">
	    <div class="col-md-12">    
	        <ul class="pagination">
	            <li <?=$class['F']?>><a href="?pagina=1">&lt;&lt;&lt; Primeira</a></li>       
	            <li <?=$class['BT']?>><a href="?pagina=<?=($pc - 10)?>">&lt;&lt; Voltar 10</a></li>
	            <li <?=$class['F']?>><a href="?pagina=<?=($pc - 1)?>">&lt; Anterior</a></li>
	            <li <?=$class['L']?>><a href="?pagina=<?=($pc + 1)?>">Próximo &gt;</a></li>
	            <li <?=$class['NT']?>><a href="?pagina=<?=($pc + 10)?>">Pular 10 &gt;&gt;</a></li>
	            <li <?=$class['L']?>><a href="?pagina=<?=$qtd_pag?>">Ultima &gt;&gt;&gt;</a></li>
	        </ul>	 
	    </div>
	</div>
</div>



<?php include("templates/rodape.php"); ?>