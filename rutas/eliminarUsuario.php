<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$id = $_POST['id'];

	$usuarioControl = new UsuarioController();
	echo $usuarioControl->eliminarUsuario($id);

?>