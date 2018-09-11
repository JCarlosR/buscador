<?php 
	include "../modelos/ResultadoDetalle.php";
	include "../datos/Conexion.php";

	class ResultadoController extends conexion {

        function listaResultados() {
            $con = $this->conectar();

            $query = 'SELECT R.id, T.termino, A.filename, R.fecha 
                    FROM resultado R
                    JOIN termino T ON R.terminoId = T.id
                    JOIN archivo A ON R.archivoId = A.id';
            $sql = $con->prepare($query);

            $sql->execute();
            return $sql->fetchAll();
        }

		public function coincidenciasResultado($idResultado)
		{
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT coincidencia FROM resultado_detalle WHERE resultadoId=:resultadoId');
			$sql->execute([
			    "resultadoId" => $idResultado
			]);

			$coincidencias = $sql->fetchAll();
			
			return json_encode([
			    "error" => false,
                "coincidencias" => $coincidencias
            ]);
		}


	}