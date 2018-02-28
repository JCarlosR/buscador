<?php

class conexion{
	function conectar(){
		try{
			$conn = new PDO('mysql:host=localhost;dbname=buscador', 'root', '');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessage();
		}
		return $conn;
	}
}

?>