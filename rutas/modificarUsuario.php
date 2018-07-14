<?php

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$id = $_POST['id'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$controller = new UsuarioController();
echo $controller->modificarUsuario($id, $email, $username, $password);
