<?php
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

$asignaturas = $this->asignaturas;
$dia = $this->dia;
$hora = $this->hora;
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
			<a href="index.php?controlador=cHorario&accion=ver&clase=<?php echo $this->clase; ?>" class="activo">Horarios</a>
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
			if ($this->error != "") {
				echo "<p class=\"error\">" . $this->error . "</p>\n";
			}
			?>

			<form action="index.php?controlador=cAsignatura&accion=guardar" method="post">

				<div class="campo">
					<label for="claseVisible">Clase</label>
					<input type="text" id="claseVisible" value="<?php echo $this->clase; ?>" readonly>
					<input type="hidden" name="clase" value="<?php echo $this->clase; ?>">
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
					<input type="submit" name="boton" value="Guardar y salir">
					<input type="submit" name="boton" value="Guardar y siguiente" class="siguiente">
					<a href="index.php?controlador=cHorario&accion=ver&clase=<?php echo $this->clase; ?>" class="cancelar">Cancelar</a>
				</div>

			</form>
		</section>
	</main>
</body>

</html>