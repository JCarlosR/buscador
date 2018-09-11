<?php 

include '../controladores/ResultadoController.php';

$c = new ResultadoController();
$resultados = $c->listaResultados();
