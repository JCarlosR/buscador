<?php 
	include "../modelos/usuario.php";
	include "../datos/conexion.php";

	class usuarioController extends conexion {
		public function __construct(){
	        $usuarios = new usuario();
	    }

		function insertarUsuario($email, $username,$password){
			if(trim($username) == "" || trim($password) == "" || trim($email) == "")
		        return json_encode(['error' => true, 'message' => 'Faltan datos por ingresar. :(']);

		    $conn = $this->conectar();
		
			$usuario = new usuario();
			$usuario->email = $email;
			$usuario->username = $username;
			$usuario->password = base64_encode($password);
			$usuario->rol = 1;

			$sql = $conn->prepare("INSERT INTO usuario(email, username, password, rol)
			    VALUES(:email, :username, :password, :rol)");
			$result = $sql->execute(array(
			    "email" => $usuario->email,
			    "username" => $usuario->username,
			    "password" => $usuario->password,
			    "rol" => $usuario->rol
			));

			if($result){
				return json_encode(['error' => false, 'message' => 'Usuario registrado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

		function validarUsuario($username,$password){
			if(trim($username) == "" || trim($password) == "")
		        return json_encode(['error' => true, 'message' => 'Faltan datos por ingresar. :(']);

			$conn = $this->conectar();
			$usuario = new usuario();
			$usuario->username = $username;
			$usuario->password = base64_encode($password);

			$sql = $conn->prepare('SELECT * FROM usuario WHERE username = :username AND password = :password');
			$sql->execute(array(
					'username' => $usuario->username,
					'password' => $usuario->password
				));
			$user = $sql->fetchAll();

	        if(count($user) > 0){
	    		session_start();
	    		foreach ($user as $row) {
		            $_SESSION["id"] = $row['id'];
		            $_SESSION["username"] = $row['username'];
		            $_SESSION["rol"] = $row['rol'];
	            }
	            return json_encode(['error' => false, 'message' => 'Usuario registrado correctamente.', 'role' => $_SESSION["rol"] ]);
	        }else{
	            return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
				
	        }
		}
		/*
		function getId($usuario,$pass){
			$con = $this->conectar();
			$usuarios = new usuarios();
			$usuarios->usuario=$usuario;
			$usuarios->contrasena = base64_encode($pass);
	        
			mysqli_select_db($con,"formLogin");
	        
			$sql = "SELECT * FROM usuarios WHERE usuario='".$usuarios->usuario."' and contrasena='".$usuarios->contrasena."'";
	        $consulta = mysqli_query($con,$sql);
	        $fila = mysqli_fetch_array($consulta);
	        if($fila>0){
	            if($fila["usuario"] == $usuarios->usuario && $fila["contrasena"]==$usuarios->contrasena){
	                return json_encode($fila);
	            }
	        }else{
	            return "";
	        }
		}*/
	}
?>