<?php
require "../Controlador/HorarioControlador.php";

$controlador = new HorarioControlador();
$asignaturas = $controlador->verAsignaturas("2DAW");

$dia = 1;
$hora = 1;

if (isset($_GET["dia"])) {
	$dia = $_GET["dia"];
	$hora = $_GET["hora"];
}

$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Alta de horario</title>
		<link rel="stylesheet" href="estilos.css">
	</head>
	<body>

		<header class="cabecera">
			<a href="https://fundacionloyola.com/vguadalupe/" class="logoEVG">
				<img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png" alt="Logotipo EVG">
			</a>
			<nav class="menu">
				<a href="verHorario.php" class="activo">Horarios</a>
				<a href="asignaturas.php">Asignaturas</a>
				<a href="profesores.php">Profesores</a>
				<a href="clases.php">Clases</a>
			</nav>
			<a href="cerrarSesion.php" class="sesion">Cerrar sesión</a>
		</header>

		<main>
			<section class="tarjeta">
				<h1>Alta de horario</h1>

				<?php
					if (isset($_GET["error"])) {
						echo "<p class=\"error\">Ya existe una asignatura a esa hora ese día</p>\n";
					}
				?>

				<form action="../Controlador/guardar.php" method="post">

					<div class="campo">
						<label for="claseVisible">Clase</label>
						<input type="text" id="claseVisible" value="2DAW" readonly>
						<input type="hidden" name="clase" value="2DAW">
					</div>

					<div class="campo">
						<label for="dia">Día</label>
						<select name="dia" id="dia">
							<?php
							for ($i = 0; $i < 5; $i++) {
								$valor = $i + 1;
								$seleccionado = "";
								if ($valor == $dia) {
									$seleccionado = " selected";
								}
								echo "<option value=\"" . $valor . "\"" . $seleccionado . ">" . $dias[$i] . "</option>\n";
							}
							?>
						</select>
					</div>

					<div class="campo">
						<label for="hora">Hora</label>
						<select name="hora" id="hora">
							<?php
							for ($i = 1; $i <= 7; $i++) {
								$seleccionado = "";
								if ($i == $hora) {
									$seleccionado = " selected";
								}
								echo "<option value=\"" . $i . "\"" . $seleccionado . ">" . $i . "ª hora</option>\n";
							}
							?>
						</select>
					</div>

					<div class="campo">
						<label for="asignatura">Asignatura</label>
						<select name="asignatura" id="asignatura">
							<?php
							for ($i = 0; $i < count($asignaturas); $i++) {
								echo "<option value=\"" . $asignaturas[$i]["nombre"] . "\">" . $asignaturas[$i]["nombre"] . " (" . $asignaturas[$i]["profesor"] . ")</option>\n";
							}
							?>
						</select>
					</div>

					<div class="botones">
						<input type="submit" name="accion" value="Guardar y salir">
						<input type="submit" name="accion" value="Guardar y siguiente" class="siguiente">
						<a href="verHorario.php" class="cancelar">Cancelar</a>
					</div>

				</form>
			</section>
		</main>

	</body>
</html>