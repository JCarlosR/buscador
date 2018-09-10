<?php 
	include "../modelos/ResultadoDetalle.php";
	include "../datos/Conexion.php";

	class ResultadoController extends conexion {
		public function __construct(){
	        $archivo = new ResultadoDetalle();
	    }

		/*function buscarTermino($termino, $archivo){
			if(trim($termino)=="")
		        return json_encode(['error' => true, 'message' => 'Ingrese el termino correctamente. :(']);

		    $conn = $this->conectar();
		
			
			// si inicia con % se reemplazará por \w sino con un ^
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

			$rawContent = file("../rutas/archivos/".$archivo);
			$content = implode(" ",$rawContent);
			$cadena = preg_replace("[\t|\n|\r|\n\r|\t\n]", "", $content);
			$listas = explode(" ", $cadena);
			$cadenas = [];
			$resultado = [];
			for ($i=0; $i < count($listas) ; $i++) { 
				$aux = trim($listas[$i]);
				array_push($cadenas, $aux);
			}
			for ($j=0; $j < count($cadenas) ; $j++) { 
				if (preg_match_all($expreg,$cadenas[$j],$coincidencias)){
				    array_push($resultado, $cadenas[$j]);
				}
			}
		}*/

		public function coincidenciasResultado($idResultado)
		{
			$conn = $this->conectar();

			$sql = $conn->prepare('SELECT coincidencia FROM resultado_detalle WHERE resultadoId=:resultadoId');
			$sql->execute(array(
			    "resultadoId" => $idResultado
			));
			$coincidencias = $sql->fetchAll();
			
			return json_encode(["error"=>false, "coincidencias"=>$coincidencias]);
		}



	}
?>