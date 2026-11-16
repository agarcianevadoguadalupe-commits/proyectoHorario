<?php
// Valores por defecto, para cuando no se entran por URL
$controlador = "cHorario";
$metodo = "ver";

// Si la URL trae las dos cosas, sustituye los valores
if (isset($_GET["controlador"]) && isset($_GET["metodo"])) {
	$controlador = $_GET["controlador"];
	$metodo = $_GET["metodo"];
}

// Elige a cuál controlador va según los parámetros
$valido = false;
if ($controlador == "cHorario" && $metodo == "ver") {
	$valido = true;
}

if ($controlador == "cAsignatura" && ($metodo == "alta" || $metodo == "guardar" || $metodo == "baja" || $metodo == "borrar")) {
	$valido = true;
}

if ($valido == false) {
	$controlador = "cHorario";
	$metodo = "ver";
}

// Carga el controlador elegido
require "Controladores/" . $controlador . ".php";
$objeto = new $controlador();

// Ejecuta el método, que devuelve el array $datos y apunta la vista en $vista
$datos = $objeto->$metodo();

// Carga la vista, que usa el array $datos
require "Vista/" . $objeto->vista;