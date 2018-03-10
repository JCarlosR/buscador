<?php 
	header('Content-type: application/json');
	include '../controladores/ArchivoController.php';

	//echo ($_FILES['archivo']['name']);
	$archivo = $_FILES['archivo'];
	$opcion = $_POST['cboOpcion'];
	$usuarios = [];
	if (isset($_POST['cboUsuarios'])) {
		$usuarios = $_POST['cboUsuarios'];
	}
	
	$archivoControl = new ArchivoController();
	echo $archivoControl->subirArchivo($archivo, $opcion, $usuarios);

?>