<?php

include "../modelos/usuario.php";
include "conexion.php";

class usuarioDatos extends conexion {

	public function __construct(){
         $usuarios = new usuario();
    }

	function insertarUsuario($email, $username, $password){

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
			return true;
		}else{
			return false;
		}

	}

    function validarUsuario($username,$password){
		$conn = $this->conectar();
		$usuario = new usuario();
		$usuario->username = $username;
		$usuario->password = base64_encode($password);

		$sql = $conn->prepare('SELECT * FROM usuario WHERE username = :username AND password = :password');
		$sql->execute(array(
				'username' => $usuario->username,
				'password' => $usuario->password
			));
		$resultado = $sql->fetchAll();
        
        if( $resultado>0 ){
            return $resultado;
        }

    }

 

    public function getDatoU($usuario,$pass){
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

    }

}
?>