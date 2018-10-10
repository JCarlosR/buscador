<?php 
	include "../modelos/ResultadoDetalle.php";
	include "../datos/Conexion.php";

	class ResultadoController extends conexion {

        function listaResultados() {
            $con = $this->conectar();

            // admin
            if ($_SESSION['rol']==2) {
                $query = 'SELECT R.id, T.termino, A.filename, R.fecha, D.coincidencia, U.username
                    FROM resultado_detalle D
                    JOIN resultado R ON D.resultadoId = R.id
                    JOIN termino T ON R.terminoId = T.id
                    JOIN usuario U ON t.usuarioId = U.id
                    JOIN archivo A ON R.archivoId = A.id';
            } else { // user
                $query = 'SELECT R.id, T.termino, A.filename, R.fecha, D.coincidencia
                    FROM resultado_detalle D
                    JOIN resultado R ON D.resultadoId = R.id
                    JOIN termino T ON R.terminoId = T.id
                    JOIN archivo A ON R.archivoId = A.id
                    WHERE T.usuarioId = ' . $_SESSION['id'];
            }

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