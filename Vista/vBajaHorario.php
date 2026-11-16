<?php
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
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
			<a href="index.php?controlador=cHorario&metodo=ver&clase=<?php echo $datos["clase"]; ?>" class="activo">Horarios</a>
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
			if ($datos["error"] != "") {
				echo "<p class='error'>" . $datos["error"] . "</p>";
			} else if ($datos["boton"] != "") {
				echo "<p class='error'>¿Seguro que quieres borrar " . $datos["fila"]["asignatura"] . " (" . $datos["fila"]["profesor"] . ") del " . $dias[$datos["dia"] - 1] . " a " . $datos["hora"] . "ª hora?</p>";
				echo "<form action='index.php?controlador=cAsignatura&metodo=borrar' method='post'>";
				echo "<input type='hidden' name='clase' value='" . $datos["clase"] . "'>";
				echo "<input type='hidden' name='dia' value='" . $datos["dia"] . "'>";
				echo "<input type='hidden' name='hora' value='" . $datos["hora"] . "'>";
				echo "<input type='hidden' name='boton' value='" . $datos["boton"] . "'>";
				echo "<input type='submit' value='Sí, borrar'>";
				echo "<a href='index.php?controlador=cAsignatura&metodo=baja&clase=" . $datos["clase"] . "&dia=" . $datos["dia"] . "&hora=" . $datos["hora"] . "' class='cancelar'>No</a>";
				echo "</form>";
			}
			?>

			<form action="index.php" method="get">
				<input type="hidden" name="controlador" value="cAsignatura">
				<input type="hidden" name="metodo" value="baja">
				<input type="hidden" name="clase" value="<?php echo $datos["clase"]; ?>">

				<div class="campo">
					<label for="dia">Día</label>
					<select name="dia" id="dia">
						<?php
						for ($i = 0; $i < 5; $i++) {
							$valor = $i + 1;
							$seleccionado = "";
							if ($valor == $datos["dia"]) {
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
							if ($i == $datos["hora"]) {
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
					<a href="index.php?controlador=cHorario&metodo=ver&clase=<?php echo $datos["clase"]; ?>" class="cancelar">Cancelar</a>
				</div>

			</form>
		</section>
	</main>
</body>

</html>