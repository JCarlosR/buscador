<?php

 class Resultado{

 	// Atributos
	public $id;
	public $terminoId;
	public $archivoId;
	public $fecha;

	// Metodos
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id = $id;
	}
	
	function get_terminoId(){
		return $this->terminoId;
	}
	function set_terminoId($terminoId){
		$this->terminoId = $terminoId;
	}

	function get_archivoId(){
		return $this->archivoId;
	}
	function set_archivoId($archivoId){
		$this->archivoId = $archivoId;
	}
	
	function get_fecha(){
		return $this->fecha;
	}
	function set_fecha($fecha){
		$this->fecha = $fecha;
	}
 }


?>