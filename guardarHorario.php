<?php
require "conexionDB.php";

$accion = $_POST["accion"];
$clase = $_POST["clase"];
$dia = $_POST["dia"];
$hora = $_POST["hora"];
$asignatura = $_POST["asignatura"];
$profesor = $_POST["profesor"];

$sql = "INSERT INTO horario (clase, dia, hora, asignatura, profesor) VALUES ('" . $clase . "', " . $dia . ", " . $hora . ", '" . $asignatura . "', '" . $profesor . "')";
$conexion->query($sql);

if ($accion == "Guardar y siguiente") {

	if ($dia == 1) {
		$ultimaHora = 7;
	} else {
		$ultimaHora = 6;
	}

	if ($hora < $ultimaHora) {
		$hora = $hora + 1;
	} else {
		$hora = 1;
		$dia = $dia + 1;
	}

	if ($dia > 5) {
		header("Location: horarios.php?clase=" . $clase);
	} else {
		header("Location: altaHorarios.php?clase=" . $clase . "&dia=" . $dia . "&hora=" . $hora);
	}

} else {
	header("Location: horarios.php?clase=" . $clase);
}