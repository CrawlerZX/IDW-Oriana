<tr>
	<td>Hostname</td>
	<td>
		<input class="form-control" type="text" required="true" name="hostName"	value="<?=$dispositivo->getHostName()?>">
	</td>
</tr>
<tr>
	<td>IP</td>
	<td>
		<input class="form-control" type="text" required="true" name="ip" value="<?=$dispositivo->getIp()?>">
	</td>
</tr>
<tr>
	<td>Tipo</td>
	<td>
		<input class="form-control" type="text" required="true" name="tipo" value="<?=$dispositivo->getTipo()?>">
	</td>
</tr>
<tr>
	<td>Fabricante</td>
	<td>
		<input class="form-control" type="text" required="true" name="fabricante" value="<?=$dispositivo->getFabricante()?>">
	</td>
</tr>
<tr>
	<td>Modelo</td>
	<td>
		<input class="form-control" type="text" required="true" name="modelo" value="<?=$dispositivo->getModelo()?>">
	</td>
</tr>
<tr>
	<td></td>
	<td><input type="checkbox" name="ativo" <?= $dispositivo->getAtivo() ? "checked='checked'" : ""; ?> value="1"> Ativo </td>
</tr>
