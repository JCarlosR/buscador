<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$usuarioControl = new UsuarioController();
	echo $usuarioControl->traerUsuarios();

?>