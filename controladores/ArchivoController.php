<?php 
	include "../modelos/Archivo.php";
	include "../datos/conexion.php";

	class ArchivoController extends conexion {
		public function __construct(){
	        $archivo = new Archivo();
	    }

		function subirArchivo($archivo, $opcion, $usuarios){

			$name_file = $archivo["tmp_name"];
			//echo ($target_file);
			if(trim($name_file) == "" )
		        return json_encode(['error' => true, 'message' => 'Ingrese un archivo. :(']);

		    $conn = $this->conectar();
		
			$usuario = new Archivo();
			$usuario->filename = $name_file;
			
			$dir_subida = '../rutas/archivos/';
			$fichero_subido = $dir_subida . basename($archivo['name']);
			//echo ($fichero_subido);

			if (move_uploaded_file($usuario->filename, $fichero_subido)) {
			    $sql = $conn->prepare("INSERT INTO archivo(filename)
			    VALUES(:filename)");
				$result = $sql->execute(array(
				    "filename" => $archivo["name"]
				));

				$idArchivo = $conn->lastInsertId();
				if ($opcion == 1) {
					$sql2 = $conn->prepare("INSERT INTO usuarios_archivos (usuarioId, archivoId)
					SELECT id, $idArchivo from usuario");
					$result2 = $sql2->execute();
					
					if($result){
						return json_encode(['error' => false, 'message' => 'Archivo registrado correctamente.']);
					
					}else{
						return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
					
					}

					if(!$result2){
						return json_encode(['error' => true, 'message' => 'Ocurrió un error en la tabla intermedia. :(']);
					
					}
				} else {
					if ($opcion == 3) {
						for ($i=0; $i < count($usuarios) ; $i++) { 
							$sql2 = $conn->prepare("INSERT INTO usuarios_archivos (usuarioId, archivoId)
							SELECT id, $idArchivo from usuario WHERE id=:id");
							$result2 = $sql2->execute(array(
							    "id" => $usuarios[$i]
							));
						}
						return json_encode(['error' => false, 'message' => 'Archivo registrado correctamente.']);
					
					}
				}
				
			} else {
				return json_encode(['error' => true, 'message' => '¡Posible ataque de subida de ficheros! :(']);
			}
		}

		function listaArchivos(){
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT * FROM archivo');
			$sql->execute();
			$files = $sql->fetchAll();
			$sql->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
			$sql = null; // obligado para cerrar la conexión
			$conn = null;
			return $files;
		}

		function eliminarArchivo($id){
			if(trim($id) == "")
		        return json_encode(['error' => true, 'message' => 'Escoja el archivo para eliminar. :(']);

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

			if($result2){
				return json_encode(['error' => false, 'message' => 'Archivo elimnado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}

		/*
		function getId($usuario,$pass){
			$con = $this->conectar();
			$usuarios = new usuarios();
			$usuarios->usuario=$usuario;
			$usuarios->contrasena = base64_encode($pass);
	        
			mysqli_select_db($con,"formLogin");
	        
			$sql = "SELECT * FROM usuarios WHERE usuario='".$usuarios->usuario."' and contrasena='".$usuarios->contrasena."'";
	        $consulta = mysqli_query($con,$sql);
	        $fila = mysqli_fetch_array($consulta);
	        if($fila>0){
	            if($fila["usuario"] == $usuarios->usuario && $fila["contrasena"]==$usuarios->contrasena){
	                return json_encode($fila);
	            }
	        }else{
	            return "";
	        }
		}*/
	}
?>