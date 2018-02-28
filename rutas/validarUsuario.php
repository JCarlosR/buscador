<?php 
	header('Content-type: application/json');
	include '../controladores/UsuarioController.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(trim($username) == "" || trim($password) == ""){
        echo json_encode(['error' => true, 'message' => 'Faltan datos por ingresar. :(']);
		return;
    }else{
    	$usuarioControl = new usuarioController();
    	$user = $usuarioControl->validarUsuario($username, $password);
    	//var_dump($user);

    	if(count($user) > 0){
    		session_start();
    		foreach ($user as $row) {
	            $_SESSION["id"] = $row['id'];
	            $_SESSION["username"] = $row['username'];
	            $_SESSION["rol"] = $row['rol'];
            }
            echo json_encode(['error' => false, 'message' => 'Usuario registrado correctamente.', 'role' => $_SESSION["rol"] ]);
			return;
        }else{
            echo json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			return;
        }
    }

?>