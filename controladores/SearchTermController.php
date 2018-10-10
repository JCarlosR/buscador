<?php

include "../modelos/Resultado.php";
include "../modelos/ResultadoDetalle.php";
include "../datos/Conexion.php";

class SearchTermController extends Conexion {

    private function convertToRegularExpression($term) {
        // beginning character
        if (substr($term, 0, 1)=="%") {
            $term = substr_replace($term, "\w",0,1);
        } else {
            $term = "^".$term;
        }
        // trailing character
        if (substr($term, -1)=="%") {
            $term = substr_replace($term, "\w",-1,1);
        } else {
            $term = $term."$";
        }

        // Replace "%" with "\w" and "*" with "."
        $regEx = str_replace("%", "\w", $term);
        $regEx = str_replace("*", ".", $regEx);
        return "/$regEx/";
    }

	public function searchTermInAllFiles($term, $idTerm) {
	    $con = $this->conectar();
        $regEx = $this->convertToRegularExpression($term);

        $files = $this->getAllFiles($con);
		foreach ($files as $file)
			$this->searchInFile($con, $file, $idTerm, $regEx);
	}

    public function searchAllTermsInAFile($file) {
        $con = $this->conectar();

        $terms = $this->getAllTerms($con);
        foreach ($terms as $term) {
            $regEx = $this->convertToRegularExpression($term['termino']);
            $this->searchInFile($con, $file, $term['id'], $regEx);
        }
    }

    private function getAllFiles($con) {
        $sql = $con->prepare('SELECT filename, id FROM archivo');
        $sql->execute();
        return $sql->fetchAll();
    }

    private function getAllTerms($con) {
        $sql = $con->prepare('SELECT termino, id FROM termino');
        $sql->execute();
        return $sql->fetchAll();
    }

	private function getAssociatedFiles($con, $idUsuario) {
		$sql = $con->prepare('SELECT A.filename, A.id 
								FROM usuarios_archivos UA 
								INNER JOIN archivo A ON UA.archivoId = A.id 
								WHERE UA.usuarioId=:userId');
		$sql->execute([
		    "userId" => $idUsuario
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
