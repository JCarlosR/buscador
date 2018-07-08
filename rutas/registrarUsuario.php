<?php 

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$controller = new UsuarioController();
echo $controller->insertarUsuario($email, $username, $password);
