<?php
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Alta de horario</title>
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
			<h1>Alta de horario</h1>

			<?php
			if ($datos["error"] != "") {
				echo "<p class='error'>" . $datos["error"] . "</p>";
			}
			?>

			<form action="index.php?controlador=cAsignatura&metodo=guardar" method="post">

				<div class="campo">
					<label for="claseVisible">Clase</label>
					<input type="text" id="claseVisible" value="<?php echo $datos["clase"]; ?>" readonly>
					<input type="hidden" name="clase" value="<?php echo $datos["clase"]; ?>">
				</div>

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
							echo "<option value='" . $valor . "'" . $seleccionado . ">" . $dias[$i] . "</option>";
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
							echo "<option value='" . $i . "'" . $seleccionado . ">" . $i . "ª hora</option>";
						}
						?>
					</select>
				</div>

				<div class="campo">
					<label for="asignatura">Asignatura</label>
					<select name="asignatura" id="asignatura">
						<?php
						for ($i = 0; $i < count($datos["asignaturas"]); $i++) {
							echo "<option value='" . $datos["asignaturas"][$i]["nombre"] . "'>" . $datos["asignaturas"][$i]["nombre"] . " (" . $datos["asignaturas"][$i]["profesor"] . ")</option>";
						}
						?>
					</select>
				</div>

				<div class="botones">
					<input type="submit" name="boton" value="Guardar y salir">
					<input type="submit" name="boton" value="Guardar y siguiente" class="siguiente">
					<a href="index.php?controlador=cHorario&metodo=ver&clase=<?php echo $datos["clase"]; ?>" class="cancelar">Cancelar</a>
				</div>

			</form>
		</section>
	</main>
</body>

</html>