<?php 

include '../controladores/ArchivoController.php';

$archivoControl = new ArchivoController();
$archivos = $archivoControl->listaArchivos();
