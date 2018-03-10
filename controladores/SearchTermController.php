<?php 
include "../modelos/Resultado.php";
include "../modelos/ResultadoDetalle.php";
session_start();
include "../datos/conexion.php";

class SearchTermController extends conexion {

	function buscarTermino($termino, $idTerm){
		$searchTerm = $termino;
		if(trim($termino)=="")
	        return json_encode(['error' => true, 'message' => 'Ingrese el termino correctamente. :(']);

	    $conn = $this->conectar();
	
		if (substr($termino, 0, 1)=="%") {
			$termino = substr_replace($termino, "\w",0,1);
		} else {
			$termino = "^".$termino;
		}
		if (substr($termino, -1)=="%") {
			$termino = substr_replace($termino, "\w",-1,1);
		} else {
			$termino = $termino."$";
		}
		// Ahora a reemplazar los % => \w y * => .
		$term = str_replace("%", "\w", $termino);
		$term = str_replace("*", ".", $term);
		$expreg = "/".$term."/";
		$resultado = [];

		$idUsuario = $_SESSION['id'];

		$sql = $conn->prepare('SELECT A.filename, A.id FROM usuarios_archivos UA 
								INNER JOIN archivo A ON UA.archivoId = A.id 
								WHERE UA.usuarioId=:usuarioId');
		$sql->execute(array(
			    "usuarioId" => $idUsuario
			));
		$files = $sql->fetchAll();

		foreach ($files as $file) {
			$rawContent = file("../rutas/archivos/".$file["filename"]);
			$content = implode(" ",$rawContent);
			$cadena = preg_replace("[\t|\n|\r|\n\r|\t\n]", "", $content);
			$listas = explode(" ", $cadena);
			$cadenas = [];
			for ($i=0; $i < count($listas) ; $i++) { 
				$aux = trim($listas[$i]);
				array_push($cadenas, $aux);
			}

			// Insert de resultado
			$resultado = new Resultado();
			$resultado->terminoId = $idTerm;
			$resultado->archivoId = $file["id"];
			$resultado->fecha = date('Y/m/d H:i:s');
		    $sql = $conn->prepare("INSERT INTO resultado(terminoId, archivoId, fecha) 
		    						VALUES(:terminoId, :archivoId, :fecha)");
			$result = $sql->execute(array(
			    "terminoId" => $resultado->terminoId,
			    "archivoId" => $resultado->archivoId,
			    "fecha" => $resultado->fecha 
			));
			$idResultado = $conn->lastInsertId();
			for ($j=0; $j < count($cadenas) ; $j++) { 
				if (preg_match_all($expreg,$cadenas[$j],$coincidencias)){
				    // Insert del resultado detalle
					$resultadoDetalle = new ResultadoDetalle();
					$resultadoDetalle->resultadoId = $idResultado;
					$resultadoDetalle->coincidencia = $cadenas[$j];
				    $sql = $conn->prepare("INSERT INTO resultado_detalle(resultadoId, coincidencia) 
				    						VALUES(:resultadoId, :coincidencia)");
					$result = $sql->execute(array(
					    "resultadoId" => $resultadoDetalle->resultadoId,
					    "coincidencia" => $resultadoDetalle->coincidencia 
					));
				    //array_push($resultado, $cadenas[$j]);
				}
			}

		}

		$sql = $conn->prepare('SELECT R.id, T.termino, A.filename, R.fecha FROM resultado R
								INNER JOIN termino T
								ON R.terminoId = T.id
								INNER JOIN archivo A
								ON R.archivoId = A.id
								 WHERE R.terminoId=:terminoId');
		$sql->execute(array(
		    "terminoId" => $idTerm
		));
		$results = $sql->fetchAll();
		
		return json_encode(['error' => false, 'results' => $results, 'termino' => $termino]);
	
	}

}
?>