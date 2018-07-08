<?php 
	include "../modelos/Usuario.php";
	include "../datos/conexion.php";

	class UsuarioController extends conexion {

		public function __construct() {
	    }

		function insertarUsuario($email, $username,$password) {
			if (trim($username) == "" || trim($password) == "" || trim($email) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Faltan datos por ingresar.'
                ]);

		    $conn = $this->conectar();
		
			$usuario = new Usuario();
			$usuario->email = $email;
			$usuario->username = $username;
			$usuario->password = base64_encode($password);
			$usuario->rol = 1;
			$usuario->activo = true;

			$query = "INSERT INTO usuario(email, username, password, rol, activo)
			    VALUES(:email, :username, :password, :rol, :activo)";

			$sql = $conn->prepare($query);
			try {
                $result = $sql->execute([
                    "email" => $usuario->email,
                    "username" => $usuario->username,
                    "password" => $usuario->password,
                    "rol" => $usuario->rol,
                    "activo" => $usuario->activo
                ]);
                if ($result) {
                    return json_encode([
                        'error' => false,
                        'message' => 'Usuario registrado correctamente.'
                    ]);
                }
            } catch(PDOException $e) {
                // $e->getMessage();
            }

            return json_encode([
                'error' => true,
                'message' => 'El nombre de usuario o el correo ya se encuentran en uso.'
            ]);
		}

		function validarUsuario($username,$password) {
			if (trim($username) == "" || trim($password) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Faltan datos por ingresar.'
                ]);

			$conn = $this->conectar();
			$usuario = new Usuario();
			$usuario->username = $username;
			$usuario->password = base64_encode($password);

			$query = 'SELECT * FROM usuario WHERE username = :username AND password = :password';
			$sql = $conn->prepare($query);

			$sql->execute([
                'username' => $usuario->username,
                'password' => $usuario->password
            ]);
			$users = $sql->fetchAll();

	        if (count($users) > 0) {
	    		session_start();
	    		foreach ($users as $row) {
		            $_SESSION["id"] = $row['id'];
		            $_SESSION["username"] = $row['username'];
		            $_SESSION["rol"] = $row['rol'];
	            }
	            return json_encode([
	                'error' => false,
                    'role' => $_SESSION["rol"]
                ]);
	        } else {
	            return json_encode([
	                'error' => true,
                    'message' => 'Los datos ingresados son incorrectos.'
                ]);
	        }
		}

		function listaUsuarios(){
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT * FROM usuario');
			$sql->execute();
			$users = $sql->fetchAll();
			return $users;
		}

		function modificarUsuario($id, $email, $username,$password){
			if(trim($username) == "" || trim($email) == "")
		        return json_encode(['error' => true, 'message' => 'Faltan datos por ingresar. :(']);

		    $conn = $this->conectar();
		
			$usuario = new Usuario();
			$usuario->id = $id;
			$usuario->email = $email;
			$usuario->username = $username;
			$usuario->password = base64_encode($password);
			if ($password == "" || $password == null) {
				$sql = $conn->prepare("UPDATE usuario SET email=:email, username=:username WHERE id=:id");
				$result = $sql->execute(array(
				    "email" => $usuario->email,
				    "username" => $usuario->username,
				    "id" => $usuario->id
				));
				if($result){
					return json_encode(['error' => false, 'message' => 'Usuario modificado correctamente.']);
				
				}else{
					return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
				
				}
			} else {
				$sql = $conn->prepare("UPDATE usuario SET email=:email, username=:username, password=:password WHERE id=:id");
				$result = $sql->execute(array(
				    "email" => $usuario->email,
				    "username" => $usuario->username,
				    "password" => $usuario->password,
				    "id" => $usuario->id
				));
				if($result){
					return json_encode(['error' => false, 'message' => 'Usuario modificado correctamente.']);
				
				}else{
					return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
				
				}
			}
			
		}

		function eliminarUsuario($id){
			if(trim($id) == "")
		        return json_encode(['error' => true, 'message' => 'Escoja al usuario para eliminar. :(']);

		    $conn = $this->conectar();
		
			$usuario = new Usuario();
			$usuario->id = $id;

			$sql = $conn->prepare("DELETE FROM usuarios_archivos WHERE usuarioId=:id");
			$result = $sql->execute(array(
			    "id" => $usuario->id
			));

			$sql2 = $conn->prepare("DELETE FROM usuario WHERE id=:id");
			$result2 = $sql2->execute(array(
			    "id" => $usuario->id
			));

			if($result2){
				return json_encode(['error' => false, 'message' => 'Usuario elimnado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

		function traerUsuarios(){
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT * FROM usuario WHERE rol=1');
			$sql->execute();
			$users = $sql->fetchAll();
			/*$sql->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
			$sql = null; // obligado para cerrar la conexión
			$conn = null;*/
			return json_encode(['error'=>false, 'usuarios'=>$users]);
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
