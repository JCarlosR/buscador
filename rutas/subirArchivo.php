<?php 
	header('Content-type: application/json');
	include '../controladores/ArchivoController.php';

	//echo ($_FILES['archivo']['name']);
	$archivo = $_FILES['archivo'];

	$archivoControl = new ArchivoController();
	echo $archivoControl->subirArchivo($archivo);

?>