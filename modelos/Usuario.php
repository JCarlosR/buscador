<?php

include "../datos/Conexion.php";

class Usuario {

	public $id;
	public $username;
	public $email;
	public $password;
	public $rol;
	public $active;
    public $reset_password_token;

	public static function find($id) {
        $connection = new Conexion();
        $con = $connection->conectar();

        $query = "SELECT 
                id, email, username, rol 
            FROM usuario 
            WHERE id = :id";
        
        $sql = $con->prepare($query);

        $sql->execute([
            'id' => $id
        ]);
        
        return $sql->fetch();
	}

 }
