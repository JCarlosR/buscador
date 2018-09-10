<?php 

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$email = $_POST['email'];
$token = $_POST['token'];
$password = $_POST['password'];

$controller = new UsuarioController();
echo $controller->confirmarClave($email, $token, $password);
