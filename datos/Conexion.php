<?php

class Conexion {
	function conectar() {
		try {
			$con = new PDO('mysql:host=localhost;dbname=buscador', 'root', '');
			// $con = new PDO('mysql:host=localhost;dbname=jevqwjto_monitor', 'jevqwjto_monitor', 'QOy4ziIk0vL8');

			
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo "ERROR: " . $e->getMessage();
		}

		return $con;
	}
}
