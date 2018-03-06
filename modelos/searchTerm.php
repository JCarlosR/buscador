<?php

 class SearchTerm{

 	// Atributos
	public $id;
	public $termino;

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
	
 }


?>