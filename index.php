<?php
// Valores por defecto, para cuando no se entran por URL
$controlador = "cHorario";
$accion = "ver";

// Si la URL trae las dos cosas, sustituye los valores
if (isset($_GET["controlador"]) && isset($_GET["accion"])) {
	$controlador = $_GET["controlador"];
	$accion = $_GET["accion"];
}

// Elige a cuál controlador va según los parámetros
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

// Carga el controlador elegido
require "Controladores/" . $controlador . ".php";
$objeto = new $controlador();

// Ejecuta las acciones que rellena atributos y carga la vista
$objeto->$accion();
$objeto->mostrar();
?>