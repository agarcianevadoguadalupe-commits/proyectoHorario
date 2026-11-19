<?php
session_start();

// Valores por defecto
$controlador = "cHorario";
$metodo = "ver";

// Lee el controlador y el método de la URL
if (isset($_GET["controlador"]) && isset($_GET["metodo"])) {
	$controlador = $_GET["controlador"];
	$metodo = $_GET["metodo"];
}

// Comprueba que la ruta esté permitida
$valido = false;

if ($controlador == "cHorario" && $metodo == "ver") {
	$valido = true;
}

if ($controlador == "cSesion" && (
	$metodo == "iniciar" || $metodo == "cerrar"
)) {
	$valido = true;
}

if ($controlador == "cAsignatura" && (
	$metodo == "alta" ||
	$metodo == "guardar" ||
	$metodo == "baja" ||
	$metodo == "borrar"
)) {
	$valido = true;
}

// Si la ruta no es válida, muestra el horario
if ($valido == false) {
	$controlador = "cHorario";
	$metodo = "ver";
}

// Solo profesores y administradores pueden modificar el horario
$puedeEditar = isset($_SESSION["id"], $_SESSION["rol"]) &&
	in_array($_SESSION["rol"], array("profesor", "administrador"), true);

if ($controlador == "cAsignatura" && !$puedeEditar) {
	header("Location: index.php?controlador=cHorario&metodo=ver");
	exit;
}

// Carga y crea el controlador
require_once "Controladores/" . $controlador . ".php";
$objeto = new $controlador();

// Ejecuta el método y recoge los datos
$datos = $objeto->$metodo();

// Carga la vista
require "Vista/" . $objeto->vista;
