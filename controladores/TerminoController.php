<?php 
	include "../modelos/Termino.php";
	include "../datos/Conexion.php";

	class TerminoController extends Conexion {

		function listaTerminos() {
			$conn = $this->conectar();

			// admin
			if ($_SESSION['rol']==2)
			    $query = 'SELECT * FROM termino t JOIN usuario u ON t.usuarioId=u.id';
			else // user
                $query = 'SELECT * FROM termino WHERE usuarioId = :id';

			$sql = $conn->prepare($query);
			$sql->execute([
			    'id' => $_SESSION["id"]
            ]);
			return $sql->fetchAll();
		}

		function insertarTermino($terminoB) {
		    session_start();

			if (trim($terminoB)=="")
		        return json_encode([
		            'error' => true,
                    'message' => 'Ingrese el termino correctamente.'
                ]);

		    $conn = $this->conectar();
		
			$termino = new Termino();
			$termino->termino = $terminoB;
			$termino->fechaCreacion = date('Y/m/d H:i:s');

			$query = "INSERT INTO termino(termino, fechaCreacion, usuarioId) 
                      VALUES(:termino, :fechaCreacion, :usuarioId)";

			$sql = $conn->prepare($query);
			$result = $sql->execute([
			    "termino" => $termino->termino,
			    "fechaCreacion" => $termino->fechaCreacion,
                "usuarioId" => $_SESSION["id"]
			]);

			if ($result) {
				return json_encode([
				    'error' => false,
                    'message' => 'Termino registrado correctamente.'
                ]);
			} else {
				return json_encode([
				    'error' => true,
                    'message' => 'Ocurrió un error inesperado.'
                ]);
			}
		}

		function eliminarTermino($id) {
			if (trim($id) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Escoja el término para eliminar.'
                ]);

		    $conn = $this->conectar();
		
			$termino = new Termino();
			$termino->id = $id;

			$sql = $conn->prepare("DELETE FROM termino WHERE id=:id");
			$result = $sql->execute(array(
			    "id" => $termino->id
			));

			if ($result) {
				return json_encode(['error' => false, 'message' => 'Término elimnado correctamente.']);
			} else {
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

	}