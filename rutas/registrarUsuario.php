<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(trim($username) == "" || trim($password) == "" || trim($email) == ""){
        echo json_encode(['error' => true, 'message' => 'Faltan datos por ingresar. :(']);
		return;
    }else{
    	$usuarioControl = new usuarioController();
    	if($usuarioControl->insertarUsuario($email, $username, $password)){
            echo json_encode(['error' => false, 'message' => 'Usuario registrado correctamente.']);
			return;
        }else{
            echo json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			return;
        }
    }

?>