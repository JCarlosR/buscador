<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$id = $_POST['id'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$usuarioControl = new usuarioController();
	echo $usuarioControl->modificarUsuario($id, $email, $username, $password);

?>