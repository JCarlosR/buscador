<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$usuarioControl = new UsuarioController();
	echo $usuarioControl->insertarUsuario($email, $username, $password);

?>