<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$id = $_POST['id'];

	$usuarioControl = new usuarioController();
	echo $usuarioControl->eliminarUsuario($id);

?>