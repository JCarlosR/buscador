<?php 
	include "../modelos/archivo.php";
	include "../datos/conexion.php";

	class archivoController extends conexion {
		public function __construct(){
	        $archivo = new archivo();
	    }

		function subirArchivo($archivo){

			$name_file = $archivo["tmp_name"];
			//echo ($target_file);
			if(trim($name_file) == "" )
		        return json_encode(['error' => true, 'message' => 'Ingrese un archivo. :(']);

		    $conn = $this->conectar();
		
			$usuario = new archivo();
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

				if($result){
					return json_encode(['error' => false, 'message' => 'Archivo registrado correctamente.']);
				
				}else{
					return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
				
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
			return $files;
		}

		/*function eliminarUsuario($id){
			if(trim($id) == "")
		        return json_encode(['error' => true, 'message' => 'Escoja al usuario para eliminar. :(']);

		    $conn = $this->conectar();
		
			$usuario = new usuario();
			$usuario->id = $id;

			$sql = $conn->prepare("DELETE FROM usuario WHERE id=:id");
			$result = $sql->execute(array(
			    "id" => $usuario->id
			));

			if($result){
				return json_encode(['error' => false, 'message' => 'Usuario elimnado correctamente.']);
			
			}else{
				return json_encode(['error' => true, 'message' => 'Ocurrió un error inesperado. :(']);
			
			}
		}*/

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