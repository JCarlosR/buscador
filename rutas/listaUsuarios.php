<?php

include '../controladores/UsuarioController.php';

$controller = new UsuarioController();
$usuarios = $controller->listaUsuarios();
