<?php 
	header('Content-type: application/json');
	include '../controladores/TerminoController.php';

	$termino = $_POST['termino'];

	$terminoControl = new TerminoController();
	echo $terminoControl->insertarTermino($termino);

?>