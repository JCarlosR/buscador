<?php 
	include '../controladores/ArchivoController.php';
	//include '../controladores/UsuarioController.php';

	$archivoControl = new ArchivoController();
	$archivos = $archivoControl->listaArchivos();

	/*$usuarioControl = new UsuarioController();
	$usuarios = $usuarioControl->traerUsuarios();*/

?>