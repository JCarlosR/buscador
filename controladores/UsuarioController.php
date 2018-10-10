<?php 
	include "../modelos/Usuario.php";

	class UsuarioController extends Conexion {

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
                    mail(
                        $usuario->email,
                        "Bienvenido!",
                        "Gracias por registrarte en la aplicación Buscador."
                    );
                    return json_encode([
                        'error' => false,
                        'message' => 'Usuario registrado correctamente.'
                    ]);
                }
            } catch (PDOException $e) {
                // $e->getMessage();
            }

            return json_encode([
                'error' => true,
                'message' => 'El nombre de usuario o el correo ya se encuentran en uso.'
            ]);
		}

		function validarUsuario($username, $password) {
			if (trim($username) == "" || trim($password) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Faltan datos por ingresar.'
                ]);

			$conn = $this->conectar();

			$usuario = new Usuario();
			$usuario->username = $username;
			$usuario->password = base64_encode($password);

			$query = 'SELECT id, username, rol, email FROM usuario WHERE username = :username AND password = :password LIMIT 1';
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
                    $_SESSION["email"] = $row['email'];
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

			$sql = $conn->prepare('SELECT id, email, username, rol, activo FROM usuario');
			$sql->execute();

			$users = $sql->fetchAll();
			return $users;
		}

		function modificarUsuario($id, $email, $username, $password) {
			$username = trim($username);
			$email = trim($email);

			if ($username == "" || $email == "")
		        return json_encode([
		        	'error' => true, 
		        	'message' => 'Faltan datos por ingresar.'
		        ]);

		    $conn = $this->conectar();
		
			$usuario = new Usuario();
			$usuario->id = $id;
			$usuario->email = $email;
			$usuario->username = $username;
			
			if ($password == "" || $password == null) {
				$sql = $conn->prepare("UPDATE usuario SET email=:email, username=:username WHERE id=:id");
				
				$result = $sql->execute(array(
				    "email" => $usuario->email,
				    "username" => $usuario->username,
				    "id" => $usuario->id
				));				
				
			} else {
				$usuario->password = base64_encode($password);

				$sql = $conn->prepare("UPDATE usuario SET email=:email, username=:username, password=:password WHERE id=:id");
				
				$result = $sql->execute(array(
				    "email" => $usuario->email,
				    "username" => $usuario->username,
				    "password" => $usuario->password,
				    "id" => $usuario->id
				));
				
			}

			if ($result)
				return json_encode([
					'error' => false, 
					'message' => 'Usuario modificado correctamente.'
				]);				
			
			return json_encode([
				'error' => true, 
				'message' => 'Ocurrió un error inesperado.'
			]);	
		
			
		}

		function eliminarUsuario($id) {
			$id = trim($id);
			if (!$id)
		        return json_encode([
		        	'error' => true, 
		        	'message' => 'Escoja al usuario para eliminar.'
		        ]);

		    $conn = $this->conectar();
		
			$usuario = new Usuario();
			$usuario->id = $id;

			$sql = $conn->prepare("DELETE FROM usuarios_archivos WHERE usuarioId=:id");
			$result = $sql->execute(array(
			    "id" => $usuario->id
			));

			$sql2 = $conn->prepare("DELETE FROM usuario WHERE id=:id");
			$result2 = $sql2->execute([
			    "id" => $usuario->id
			]);

			if ($result2) {
				return json_encode([
					'error' => false, 
					'message' => 'Usuario elimnado correctamente.'
				]);
			
			} else {
				return json_encode([
					'error' => true, 
					'message' => 'Ocurrió un error inesperado.'
				]);			
			}
		}

		function traerUsuarios() {
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT * FROM usuario WHERE rol=1');
			$sql->execute();
			$users = $sql->fetchAll();

			return json_encode([
				'error' => false, 
				'usuarios' => $users
			]);
		}

        function recuperarClave($email) {
            if (trim($email) == "")
                return json_encode([
                    'error' => true,
                    'message' => 'Faltan datos por ingresar.'
                ]);

            $conn = $this->conectar();

            $usuario = new Usuario();
            $usuario->email = $email;
            $usuario->reset_password_token = substr(str_shuffle(MD5(microtime())), 0, 60);

            $query = "UPDATE usuario SET reset_password_token = :token WHERE  email = :email";

            $sql = $conn->prepare($query);
            try {
                $result = $sql->execute([
                    "email" => $usuario->email,
                    "token" => $usuario->reset_password_token
                ]);
                if ($result) {
                    mail(
                        $usuario->email,
                        "Recupera tu contraseña!",
                        "Por tu seguridad, por favor genera una contraseña nueva visitando el siguiente enlace: "
                        . "http://jevq.website/vistas/generarNuevaPassword.php?email=" . $usuario->email
                        . "&token=" . $usuario->reset_password_token
                    );
                    return json_encode([
                        'error' => false,
                        'message' => 'Se ha enviado el enlace por correo.'
                    ]);
                }
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }

            return json_encode([
                'error' => true,
                'message' => $errorMessage // 'El email indicado no se encuentra en uso.'
            ]);
        }

        function confirmarClave($email, $token, $password) {
            if (trim($email) == "" || trim($token) == "" || trim($password) == "")
                return json_encode([
                    'error' => true,
                    'message' => 'Faltan datos por ingresar.'
                ]);

            $conn = $this->conectar();

            $usuario = new Usuario();
            $usuario->email = $email;
            $usuario->reset_password_token = $token;
            $usuario->password = base64_encode($password);

            $query = "UPDATE usuario SET password = :password, reset_password_token = NULL 
                      WHERE  email = :email 
                      AND reset_password_token = :token AND reset_password_token is NOT NULL";

            $sql = $conn->prepare($query);
            try {
                $result = $sql->execute([
                    "email" => $usuario->email,
                    "token" => $usuario->reset_password_token,
                    "password" => $usuario->password
                ]);
                if ($result) {
                    if ($sql->rowCount() > 0)
                        mail(
                            $usuario->email,
                            "Tu contraseña ha sido modificada!",
                            "Recibes este mensaje como confirmación de que tu contraseña se ha actualizado correctamente! "
                            . "Si no eres consciente de este cambio, por favor contacta al administrador."
                        );
                    return json_encode([
                        'error' => false,
                        'message' => 'Si el token es  válido, la contraseña se ha modificado y recibirás una confirmación por correo.'
                    ]);
                }
            } catch (PDOException $e) {
                return json_encode([
                    'error' => true,
                    'message' => $e->getMessage()
                ]);
            }

            return json_encode([
                'error' => true,
                'message' => 'Ocurrió un error inesperado.'
            ]);
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
