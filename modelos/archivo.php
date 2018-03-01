<?php

 class archivo{

 	// Atributos
	public $id;
	public $filename;

	// Metodos
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id = $id;
	}
	
	function get_filename(){
		return $this->filename;
	}
	function set_filename($filename){
		$this->filename = $filename;
	}
	
 }


?>