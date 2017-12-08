<?php

class DispositivoDao{

		private $conexao;

		function __construct($conexao){
			$this->conexao = $conexao;
		}

		function listaDispositivos($pag = 1) {
			$resultado = mysqli_query($this->conexao, "SELECT * FROM dispositivos");			
			$qtd_registros = mysqli_num_rows($resultado);
			$inicio = ($pag - 1) * 5;
			$resultado = mysqli_query($this->conexao, "SELECT * FROM dispositivos LIMIT {$inicio}, 5");
			$dispositivos = array();

			while($dispositivo_array = mysqli_fetch_assoc($resultado)) {

				$dispositivo = new Dispositivo($params);
				$dispositivo->setId($dispositivo_array['ID']);
				$dispositivo->setHostName($dispositivo_array['hostname']);
				$dispositivo->setIp($dispositivo_array['ip']);
				$dispositivo->setTipo($dispositivo_array['tipo']);
				$dispositivo->setFabricante($dispositivo_array['fabricante']);
				$dispositivo->setModelo($dispositivo_array['modelo']);
				$dispositivo->setAtivo($dispositivo_array['ativo']);
				$dispositivo->setCreated_time($dispositivo_array['created_time']);
				
				array_push($dispositivos, $dispositivo);
			}
			$dispositivos['qtd_registros'] = $qtd_registros;
			$dispositivos['qtd'] = ceil($qtd_registros / 5);
			return $dispositivos;
		}

		function insereDispositivo(Dispositivo $dispositivo) {
		    $query = "insert into dispositivos (hostName, ip, tipo, fabricante, modelo, ativo) 
			    values (
				    '{$dispositivo->getHostName()}', 
				    '{$dispositivo->getIp()}', 
				    '{$dispositivo->getTipo()}', 
				    '{$dispositivo->getFabricante()}', 
				    '{$dispositivo->getModelo()}', 
				    '{$dispositivo->getAtivo()}'
			    )";

		    return mysqli_query($this->conexao, $query);
		}

		function alteraDispositivo(Dispositivo $dispositivo) {			
			$query =   "update dispositivos set 
							hostname     = '{$dispositivo->getHostName()}', 
						    ip           = '{$dispositivo->getIp()}', 
						    tipo         = '{$dispositivo->getTipo()}', 
						    fabricante   = '{$dispositivo->getFabricante()}', 
						    modelo       = '{$dispositivo->getModelo()}', 
						    ativo        = '{$dispositivo->getAtivo()}'
					    where id = '{$dispositivo->getId()}'";

			return mysqli_query($this->conexao, $query);
		}

		function buscaDispositivo($id) {

			$query = "select * from dispositivos where id = {$id}";
			$resultado = mysqli_query($this->conexao, $query);
			$dispositivo_buscado = mysqli_fetch_assoc($resultado);
			$dispositivo = new Dispositivo($dispositivo_buscado);
			$dispositivo->setId($dispositivo_buscado['ID']);
			$dispositivo->setHostName($dispositivo_buscado['hostname']);

			return $dispositivo;
		}

		function removeDispositivo($id) {

			$query = "delete from dispositivos where id = {$id}";

			return mysqli_query($this->conexao, $query);
		}
	}
