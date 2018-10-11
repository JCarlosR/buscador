<?php 
	include "../modelos/Archivo.php";
    include "SearchTermController.php";

	class ArchivoController extends conexion {

		function subirArchivo($archivo, $opcion, $usuarios){
			$name_file = $archivo["tmp_name"];
			if (trim($name_file) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Debe seleccionar el archivo a subir'
                ]);

		    $conn = $this->conectar();
		
			$usuario = new Archivo();
			$usuario->filename = $name_file;
			
			$dir_subida = '../rutas/archivos/';
			$fileName = $archivo["name"];
			$fichero_subido = $dir_subida . basename($fileName);

			if (move_uploaded_file($usuario->filename, $fichero_subido)) {
			    $sql = $conn->prepare("INSERT INTO archivo(filename) VALUES (:filename)");
				$result = $sql->execute([
				    'filename' => $fileName
				]);
                if (!$result) {
                    return json_encode([
                        'error' => true,
                        'message' => 'Ocurrió un error inesperado.'
                    ]);
                }

				$idArchivo = $conn->lastInsertId();
				if ($opcion == 1) {
					$sql2 = $conn->prepare("INSERT INTO usuarios_archivos (usuarioId, archivoId)
					SELECT id, $idArchivo FROM usuario");
					$result2 = $sql2->execute();
					
					if (!$result2) {
						return json_encode([
						    'error' => true,
                            'message' => 'Ocurrió un error inesperado.'
                        ]);
					}

				} else if ($opcion == 3) {
                    for ($i=0; $i < count($usuarios) ; $i++) {
                        $query = "INSERT INTO usuarios_archivos (usuarioId, archivoId)
                                  VALUES (:usuarioId, :archivoId)";
                        $sql2 = $conn->prepare($query);
                        $result2 = $sql2->execute([
                            'usuarioId' => $usuarios[$i],
                            'archivoId' => $idArchivo
                        ]);

                        if (!$result2) {
                            return json_encode([
                                'error' => true,
                                'message' => 'Ocurrió un error inesperado.'
                            ]);
                        }
                    }
				}

				$searchController = new SearchTermController();
				$file = [];
				$file['filename'] = $fileName;
                $file['id'] = $idArchivo;
				$searchController->searchAllTermsInAFile($file);

                return json_encode([
                    'error' => false,
                    'message' => 'Archivo registrado correctamente.'
                ]);

            } else {
				return json_encode([
				    'error' => true,
                    'message' => 'Posible ataque de subida de ficheros!'
                ]);
			}
		}

		function listaArchivos(){
			$con = $this->conectar();

			if ($_SESSION['rol']==2) {
                $sql = $con->prepare('SELECT * FROM archivo');
            } else {
			    $query = "SELECT A.* 
                          FROM usuarios_archivos UA
                          JOIN archivo A ON UA.archivoId = A.id
                          WHERE UA.usuarioId = :userId";
                $sql = $con->prepare($query, [
                    'userId' => $_SESSION['id']
                ]);
            }
			$sql->execute();

			return $sql->fetchAll();
		}

		function eliminarArchivo($id){
			if (trim($id) == "")
		        return json_encode([
		            'error' => true,
                    'message' => 'Escoja el archivo para eliminar.'
                ]);

		    $conn = $this->conectar();
		
			$archivo = new Archivo();
			$archivo->id = $id;

			$sql = $conn->prepare("DELETE FROM usuarios_archivos WHERE archivoId=:id");
			$result = $sql->execute(array(
			    "id" => $archivo->id
			));

			$sql2 = $conn->prepare("DELETE FROM archivo WHERE id=:id");
			$result2 = $sql2->execute(array(
			    "id" => $archivo->id
			));

			if($result && $result2){
				return json_encode([
				    'error' => false,
                    'message' => 'Archivo elimnado correctamente.'
                ]);
			} else {
				return json_encode([
				    'error' => true,
                    'message' => 'Ocurrió un error inesperado.'
                ]);
			}
		}

	}