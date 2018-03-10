<?php 
	header('Content-type: application/json');
	include '../controladores/SearchTermController.php';

	$termino = $_POST['term'];
	$idTerm = $_POST['idTerm'];

	$searchTermControl = new SearchTermController();
	echo $searchTermControl->buscarTermino($termino, $idTerm);

?>