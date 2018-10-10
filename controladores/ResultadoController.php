<?php 
	include "../modelos/ResultadoDetalle.php";
	include "../datos/Conexion.php";

	class ResultadoController extends conexion {

        public function listaResultados() {
            $con = $this->conectar();

            // admin
            if ($_SESSION['rol']==2) {
                $query = 'SELECT D.id, T.termino, A.filename, R.fecha, D.coincidencia, U.username
                    FROM resultado_detalle D
                    JOIN resultado R ON D.resultadoId = R.id
                    JOIN termino T ON R.terminoId = T.id
                    JOIN usuario U ON t.usuarioId = U.id
                    JOIN archivo A ON R.archivoId = A.id';
            } else { // user
                $query = 'SELECT D.id, T.termino, A.filename, R.fecha, D.coincidencia
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

        public function enviarCoincidenciaPorMail($coincidenciaId) {
            $query = 'SELECT D.id, T.termino, A.filename, R.fecha, D.coincidencia, U.username
                    FROM resultado_detalle D
                    JOIN resultado R ON D.resultadoId = R.id
                    JOIN termino T ON R.terminoId = T.id
                    JOIN usuario U ON t.usuarioId = U.id
                    JOIN archivo A ON R.archivoId = A.id
                    WHERE D.id = ' . $coincidenciaId;

            $con = $this->conectar();
            $sql = $con->prepare($query);
            $sql->execute();

            $coincidencia = $sql->fetchAll()[0];

            date_default_timezone_set('America/Lima');
            mail(
                $_SESSION['email'],
                "Resultados solicitados",
                "Hola. A continuación los datos que solicitó recibir por mail: "
                . "\n- ID Coincidencia: " . $coincidenciaId
                . "\n- Término de búsqueda: " . $coincidencia['termino']
                . "\n- Término encontrado: " . $coincidencia['coincidencia']
                . "\n- Usuario: " . $coincidencia['username']
                . "\n- Fecha de búsqueda: ". $coincidencia['fecha']
                . "\n- Fecha de envío del mail: ". date("Y-m-d H:i:s")
            );

            return json_encode([
                'error' => false,
                'message' => 'Se ha enviado el resultado a su correo.'
            ]);
        }
	}