<?php
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

$fila = $this->fila;
$dia = $this->dia;
$hora = $this->hora;
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Baja de horario</title>
	<link rel="stylesheet" href="Vista/estilos.css">
</head>

<body>
	<header class="cabecera">
		<a href="https://fundacionloyola.com/vguadalupe/" class="logoEVG">
			<img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png" alt="Logotipo EVG">
		</a>
		<nav class="menu">
			<a href="index.php?controlador=cHorario&accion=ver&clase=<?php echo $this->clase; ?>" class="activo">Horarios</a>
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
			if ($this->error != "") {
				echo "<p class=\"error\">" . $this->error . "</p>\n";
			} else if ($this->boton != "") {
				echo "<p class=\"error\">¿Seguro que quieres borrar " . $fila["asignatura"] . " (" . $fila["profesor"] . ") del " . $dias[$dia - 1] . " a " . $hora . "ª hora?</p>\n";
				echo "<form action=\"index.php?controlador=cAsignatura&accion=borrar\" method=\"post\">\n";
				echo "<input type=\"hidden\" name=\"clase\" value=\"" . $this->clase . "\">\n";
				echo "<input type=\"hidden\" name=\"dia\" value=\"" . $dia . "\">\n";
				echo "<input type=\"hidden\" name=\"hora\" value=\"" . $hora . "\">\n";
				echo "<input type=\"hidden\" name=\"boton\" value=\"" . $this->boton . "\">\n";
				echo "<input type=\"submit\" value=\"Sí, borrar\">\n";
				echo "<a href=\"index.php?controlador=cAsignatura&accion=baja&clase=" . $this->clase . "&dia=" . $dia . "&hora=" . $hora . "\" class=\"cancelar\">No</a>\n";
				echo "</form>\n";
			}
			?>

			<form action="index.php" method="get">
				<input type="hidden" name="controlador" value="cAsignatura">
				<input type="hidden" name="accion" value="baja">
				<input type="hidden" name="clase" value="<?php echo $this->clase; ?>">

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
					<input type="submit" name="boton" value="Borrar">
					<input type="submit" name="boton" value="Borrar y siguiente" class="siguiente">
					<a href="index.php?controlador=cHorario&accion=ver&clase=<?php echo $this->clase; ?>" class="cancelar">Cancelar</a>
				</div>

			</form>
		</section>
	</main>
</body>

</html>