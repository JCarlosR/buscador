<?php 
	header('Content-type: application/json');
	include '../controladores/ArchivoController.php';

	//echo ($_FILES['archivo']['name']);
	$archivo = $_FILES['archivo'];

	$archivoControl = new archivoController();
	echo $archivoControl->subirArchivo($archivo);

?>