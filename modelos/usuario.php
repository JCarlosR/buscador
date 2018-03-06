<?php

 class Usuario{

 	// Atributos
	public $id;
	public $username;
	public $email;
	public $password;
	public $rol;
	public $activo;

	// Metodos
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id = $id;
	}
	
	function get_username(){
		return $this->username;
	}
	function set_username($username){
		$this->username = $username;
	}
	
	function get_password(){
		return $this->password;
	}
	function set_password($password){
		$this->password = $password;
	}

	function get_email(){
		return $this->email;
	}
	function set_email($email){
		$this->email = $email;
	}
	
	function get_rol(){
		return $this->rol;
	}
	function set_rol($rol){
		$this->rol = $rol;
	}
 }


?>