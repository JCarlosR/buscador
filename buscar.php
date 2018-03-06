<?php

$patron = '/\wglor.a$/';
$rawContent = file("rutas/archivos/FUNCIONALIDAD.txt"); //O usa una URL
$content = implode(" ",$rawContent);//Ya tenemos la cadena en memoria
$cadena = preg_replace("[\t|\n|\r|\n\r|\t\n]", "", $content);
$listas = explode(" ", $cadena);
$cadenas = [];
$resultado = [];
for ($i=0; $i < count($listas) ; $i++) { 
	$aux = trim($listas[$i]);
	array_push($cadenas, $aux);
}
//var_dump($cadenas);
for ($j=0; $j < count($cadenas) ; $j++) { 
	if (preg_match_all($patron,$cadenas[$j],$coincidencias)){
		//var_dump($coincidencias);
	    array_push($resultado, $cadenas[$j]);
	}

}

var_dump($resultado);

$terminoBus = "%glor*a";
echo $terminoBus."<br>";

// si inicia con % se reemplazará por \w sino con un ^
if (substr($terminoBus, 0, 1)=="%") {
	$terminoBus = substr_replace($terminoBus, "\w",0,1);
} else {
	$terminoBus = "^".$terminoBus;
}
if (substr($terminoBus, -1)=="%") {
	$terminoBus = substr_replace($terminoBus, "\w",-1,1);
} else {
	$terminoBus = $terminoBus."$";
}
// Ahora a reemplazar los % => \w y * => .
$term = str_replace("%", "\w", $terminoBus);
$term = str_replace("*", ".", $term);
$expreg = "/".$term."/";
echo "<br>";
echo $expreg;

?>