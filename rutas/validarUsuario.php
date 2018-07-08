<?php

header('Content-type: application/json');
include '../controladores/UsuarioController.php';

$username = $_POST['username'];
$password = $_POST['password'];

$controller = new UsuarioController();
echo $controller->validarUsuario($username, $password);
