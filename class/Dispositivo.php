<?php

class Dispositivo {

		private $id;
		private $hostName;
		private $ip;
		private $tipo;
		private $fabricante;
		private $modelo;
		private $ativo;
		private $created_time;

		function __construct($params){
			$this->hostName = $params['hostName'];
			$this->ip = $params['ip'];
			$this->tipo = $params['tipo'];
			$this->fabricante = $params['fabricante'];
			$this->modelo = $params['modelo'];
			$this->ativo = $params['ativo'];
		}

		public function setHostName($hostName){
			$this->hostName = $hostName;
		}

		public function getHostName(){
			return $this->hostName;
		}


		public function setIp($ip) {
			$this->ip = $ip;
		}

		public function getIp() {
			return $this->ip;
		}

		public function setTipo($tipo) {
			$this->tipo = $tipo;
		}

		public function getTipo() {
			return $this->tipo;
		}

		public function setFabricante($fabricante) {
			$this->fabricante = $fabricante;
		}

		public function getFabricante() {
			return $this->fabricante;
		}

		public function setModelo($modelo) {
			$this->modelo = $modelo;
		}

		public function getModelo() {
			return $this->modelo;
		}

		public function setAtivo($ativo) {
			$this->ativo = $ativo;
		}

		public function getAtivo() {
			return $this->ativo;
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setCreated_time($created_time) {
			$this->created_time = $created_time;
		}

		public function getCreated_time() {
			return $this->created_time;
		}
}

?>