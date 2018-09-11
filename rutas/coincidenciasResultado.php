<?php 

header('Content-type: application/json');
include '../controladores/ResultadoController.php';

$idResultado = $_POST['idResultado'];

$resultadoControl = new ResultadoController();
echo $resultadoControl->coincidenciasResultado($idResultado);
