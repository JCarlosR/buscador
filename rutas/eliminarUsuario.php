<?php 

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$id = $_POST['id'];

$controller = new UsuarioController();
echo $controller->eliminarUsuario($id);
