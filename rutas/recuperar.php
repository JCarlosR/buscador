<?php 

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$email = $_POST['email'];

$controller = new UsuarioController();
echo $controller->recuperarClave($email);
