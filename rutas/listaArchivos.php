<?php 
	include '../controladores/ArchivoController.php';

	$archivoControl = new archivoController();
	$archivos = $archivoControl->listaArchivos();

?>