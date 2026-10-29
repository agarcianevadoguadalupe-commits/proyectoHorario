<?php
require "../Controlador/HorarioControlador.php";

$dia = 1;
$hora = 1;

if (isset($_GET["dia"])) {
	$dia = $_GET["dia"];
	$hora = $_GET["hora"];
}

$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

// Solo se busca la fila cuando se ha pulsado Borrar
if (isset($_GET["accion"])) {
	$controlador = new HorarioControlador();
	$fila = $controlador->verUna("2DAW", $dia, $hora);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Baja de horario</title>
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
			<h1>Baja de horario</h1>

			<?php
			if (isset($_GET["accion"])) {
				if ($fila) {
					echo "<p class=\"error\">¿Seguro que quieres borrar " . $fila["asignatura"] . " (" . $fila["profesor"] . ") del " . $dias[$dia - 1] . " a " . $hora . "ª hora?</p>\n";
					echo "<form action=\"../Controlador/borrar.php\" method=\"post\">\n";
					echo "<input type=\"hidden\" name=\"clase\" value=\"2DAW\">\n";
					echo "<input type=\"hidden\" name=\"dia\" value=\"" . $dia . "\">\n";
					echo "<input type=\"hidden\" name=\"hora\" value=\"" . $hora . "\">\n";
					echo "<input type=\"hidden\" name=\"accion\" value=\"" . $_GET["accion"] . "\">\n";
					echo "<input type=\"submit\" value=\"Sí, borrar\">\n";
					echo "<a href=\"bajaHorario.php?dia=" . $dia . "&hora=" . $hora . "\" class=\"cancelar\">No</a>\n";
					echo "</form>\n";
				} else {
					echo "<p class=\"error\">No hay ninguna asignatura el " . $dias[$dia - 1] . " a " . $hora . "ª hora</p>\n";
				}
			}
			?>

			<form action="bajaHorario.php" method="get">

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

				<div class="botones">
					<input type="submit" name="accion" value="Borrar">
					<input type="submit" name="accion" value="Borrar y siguiente" class="siguiente">
					<a href="verHorario.php" class="cancelar">Cancelar</a>
				</div>

			</form>
		</section>
	</main>

</body>
</html>