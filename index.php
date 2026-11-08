<?php
$controlador = "cHorario";
$accion = "ver";

if (isset($_GET["controlador"]) && isset($_GET["accion"])) {
	$controlador = $_GET["controlador"];
	$accion = $_GET["accion"];
}

// Solo se permiten estas combinaciones de controlador y acción
$valido = false;
if ($controlador == "cHorario" && $accion == "ver") {
	$valido = true;
}
if ($controlador == "cAsignatura" && ($accion == "alta" || $accion == "guardar" || $accion == "baja" || $accion == "borrar")) {
	$valido = true;
}
if ($valido == false) {
	$controlador = "cHorario";
	$accion = "ver";
}

require "Controlador/" . $controlador . ".php";
$objeto = new $controlador();

$objeto->$accion();
$objeto->mostrar();
?>