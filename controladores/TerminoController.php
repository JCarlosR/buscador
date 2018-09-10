<?php 
	include "../modelos/Termino.php";
	include "../datos/Conexion.php";

	class TerminoController extends conexion {
		public function __construct(){
	        $archivo = new Termino();
	    }

		function listaTerminos(){
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT * FROM termino');
			$sql->execute();
			$termino = $sql->fetchAll();
			return $termino;
		}

		function insertarTermino($terminoB){
			if(trim($terminoB)=="")
		        return json_encode(['error' => true, 'message' => 'Ingrese el termino correctamente. :(']);

		    $conn = $this->conectar();
		
			$termino = new Termino();
			$termino->termino = $terminoB;
			$termino->fechaCreacion = date('Y/m/d H:i:s');

			$sql = $conn->prepare("INSERT INTO termino(termino, fechaCreacion) VALUES(:termino, :fechaCreacion)");
			$result = $sql->execute(array(
			    "termino" => $termino->termino,
			    "fechaCreacion" => $termino->fechaCreacion
			));

			if($result){
				return json_encode(['error' => false, 'message' => 'Termino registrado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

		function eliminarTermino($id){
			if(trim($id) == "")
		        return json_encode(['error' => true, 'message' => 'Escoja el término para eliminar. :(']);

		    $conn = $this->conectar();
		
			$termino = new Termino();
			$termino->id = $id;

			$sql = $conn->prepare("DELETE FROM termino WHERE id=:id");
			$result = $sql->execute(array(
			    "id" => $termino->id
			));

			if($result){
				return json_encode(['error' => false, 'message' => 'Término elimnado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

	}
?>