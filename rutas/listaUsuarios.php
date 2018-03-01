<?php 
	include '../controladores/UsuarioController.php';

	$usuarioControl = new usuarioController();
	$usuarios = $usuarioControl->listaUsuarios();

?>