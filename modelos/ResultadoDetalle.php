<?php

 class ResultadoDetalle{

 	// Atributos
	public $id;
	public $resultadoId;
	public $coincidencia;

	// Metodos
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id = $id;
	}
	
	function get_resultadoId(){
		return $this->resultadoId;
	}
	function set_resultadoId($resultadoId){
		$this->resultadoId = $resultadoId;
	}

	function get_coincidencia(){
		return $this->coincidencia;
	}
	function set_coincidencia($coincidencia){
		$this->coincidencia = $coincidencia;
	}
 }


?>