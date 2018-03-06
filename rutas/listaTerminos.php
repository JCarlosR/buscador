<?php 
	include '../controladores/TerminoController.php';

	$terminoControl = new TerminoController();
	$terminos = $terminoControl->listaTerminos();

?>