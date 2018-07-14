<?php 

header('Content-type: application/json');
include '../controladores/SearchTermController.php';

$termino = $_POST['term'];
$idTerm = $_POST['idTerm'];

$controller = new SearchTermController();
echo $controller->buscarTermino($termino, $idTerm);
