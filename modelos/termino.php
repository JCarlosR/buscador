<?php

 class Termino{

 	// Atributos
	public $id;
	public $termino;
	public $fechaCreacion;

	// Metodos
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id = $id;
	}
	
	function get_termino(){
		return $this->termino;
	}
	function set_termino($termino){
		$this->termino = $termino;
	}
	
	function get_fechaCreacion(){
		return $this->fechaCreacion;
	}
	function set_fechaCreacion($fechaCreacion){
		$this->fechaCreacion = $fechaCreacion;
	}
 }


?>