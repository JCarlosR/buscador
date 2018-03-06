<?php 
	header('Content-type: application/json');
	include '../controladores/ArchivoController.php';

	$id = $_POST['id'];

	$archivoControl = new ArchivoController();
	echo $archivoControl->eliminarArchivo($id);

?>