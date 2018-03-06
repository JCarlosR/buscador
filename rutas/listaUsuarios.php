<?php 
	include '../controladores/UsuarioController.php';

	$usuarioControl = new UsuarioController();
	$usuarios = $usuarioControl->listaUsuarios();

?>