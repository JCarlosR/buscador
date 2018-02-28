<?php 
	include "../datos/usuarioDatos.php";

	class usuarioController{
		function insertarUsuario($email, $username,$password){
		    $obj = new usuarioDatos();
		    return $obj->insertarUsuario($email,$username, $password);
		}

		function validarUsuario($username,$password){
			$obj = new usuarioDatos();
		    return $obj->validarUsuario($username,$password);
		}
		/*
		function getId($usuario,$pass){
			$obj = new usuarioDatos();
			return $obj->getId($usuario,$pass);
		}*/
	}
?>