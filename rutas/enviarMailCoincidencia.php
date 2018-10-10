<?php 

header('Content-type: application/json');
include '../controladores/ResultadoController.php';

$controller = new ResultadoController();
echo $controller->enviarCoincidenciaPorMail($_POST['coincidenciaId']);
