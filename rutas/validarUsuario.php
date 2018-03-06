<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$usuarioControl = new UsuarioController();
	echo $usuarioControl->validarUsuario($username, $password);

?>