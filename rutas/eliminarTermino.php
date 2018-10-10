<?php 

header('Content-type: application/json');
include '../controladores/TerminoController.php';

$id = $_POST['id'];

$terminoControl = new TerminoController();
echo $terminoControl->eliminarTermino($id);
