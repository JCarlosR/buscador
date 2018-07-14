<?php 
include "../modelos/Resultado.php";
include "../modelos/ResultadoDetalle.php";
include "../datos/Conexion.php";

session_start();

class SearchTermController extends Conexion {

	public function buscarTermino($termino, $idTerm) {
		$searchTerm = trim($termino);
		
		if ($searchTerm == "")
	        return json_encode([
	        	'error' => true, 
	        	'message' => 'Ingrese el termino correctamente.'
	        ]);

	    $con = $this->conectar();
	
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
		
		// Reemplazar % por \w y * por .
		$regEx = str_replace("%", "\w", $termino);
		$regEx = str_replace("*", ".", $regEx);
		$regEx = "/$regEx/";

		$resultado = [];

		$idUsuario = $_SESSION['id'];
		$files = $this->getAssociatedFiles($con, $idUsuario);
		
		foreach ($files as $file)
			$this->searchInFile($con, $file, $idTerm, $regEx);

		$sql = $con->prepare('SELECT R.id, T.termino, A.filename, R.fecha FROM resultado R
								INNER JOIN termino T
								ON R.terminoId = T.id
								INNER JOIN archivo A
								ON R.archivoId = A.id
								WHERE R.terminoId=:terminoId');
		$sql->execute([
		    "terminoId" => $idTerm
		]);

		$results = $sql->fetchAll();
		
		return json_encode([
			'error' => false, 
			'results' => $results, 
			'termino' => $termino
		]);	
	}

	private function getAssociatedFiles($con, $idUsuario) {
		$sql = $con->prepare('SELECT A.filename, A.id 
								FROM usuarios_archivos UA 
								INNER JOIN archivo A ON UA.archivoId = A.id 
								WHERE UA.usuarioId=:usuarioId');
		$sql->execute([
		    "usuarioId" => $idUsuario
		]);

		return $sql->fetchAll();
	}

	private function searchInFile($con, $file, $idTerm, $regEx)
	{
		$rawContent = file("../rutas/archivos/".$file["filename"]);
		
		$content = implode(" ", $rawContent);
		$cadena = preg_replace("[\t|\n|\r|\n\r|\t\n]", "", $content);
		$listas = explode(" ", $cadena);

		/*
		$listas = preg_replace("[\t|\n|\r|\n\r|\t\n]", "", $rawContent);
		var_dump($listas);
		die;
		*/

		$cadenas = array_map('trim', $listas);

		// Resultado (cabecera)
		$resultado = new Resultado();
		$resultado->terminoId = $idTerm;
		$resultado->archivoId = $file["id"];
		$resultado->fecha = date('Y/m/d H:i:s');

	    $sql = $con->prepare("INSERT INTO resultado(terminoId, archivoId, fecha) 
	    						VALUES(:terminoId, :archivoId, :fecha)");

		$result = $sql->execute([
		    "terminoId" => $resultado->terminoId,
		    "archivoId" => $resultado->archivoId,
		    "fecha" => $resultado->fecha 
		]);

		$idResultado = $con->lastInsertId();
		
		foreach ($cadenas as $cadena) { 
			if (preg_match_all($regEx, $cadena)) {
			    // Resultado (detalle)
				$detalle = new ResultadoDetalle();
				$detalle->resultadoId = $idResultado;
				$detalle->coincidencia = $cadena;
			    
			    $sql = $con->prepare("INSERT INTO resultado_detalle(resultadoId, coincidencia) 
			    						VALUES(:resultadoId, :coincidencia)");
				
				$result = $sql->execute([
				    "resultadoId" => $detalle->resultadoId,
				    "coincidencia" => $detalle->coincidencia 
				]);
			}
		}

	}
}
