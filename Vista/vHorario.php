<?php
$franjas = array("08:15 - 09:10", "09:10 - 10:05", "10:05 - 11:00", "11:30 - 12:25", "12:25 - 13:20", "13:20 - 14:15", "14:15 - 15:00");
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

$colores = array(
	"IP" => "ip",
	"CLIENTE" => "cliente",
	"SERVIDOR" => "servidor",
	"PIMOD" => "pimod",
	"DESPLIEGUE" => "despliegue",
	"SOST." => "sost",
	"OPT. 1" => "opt1",
	"OPT. 2" => "opt2",
	"DIGIT." => "digit",
	"TUTORÍA" => "tutoria"
);

$horario = $this->horario;
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Horario <?php echo $this->clase; ?></title>
	<link rel="stylesheet" href="Vista/estilos.css">
</head>

<body>
	<header class="cabecera">
		<a href="https://fundacionloyola.com/vguadalupe/" class="logoEVG">
			<img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png" alt="Logotipo EVG">
		</a>
		<nav class="menu">
			<a href="clases.php" class="activo">Clases</a>
		</nav>
		<a href="index.php?controlador=cAsignatura&accion=alta&clase=<?php echo $this->clase; ?>" class="sesion">Iniciar sesión</a>
	</header>

	<main>
		<?php
		if ($this->error != "") {
			echo "<p class=\"error\">" . $this->error . "</p>\n";
		}
		?>

		<table>
			<?php
			// Fila de encabezado con los días
			echo "<tr>\n";
			echo "<th></th>\n";
			for ($i = 0; $i < 5; $i++) {
				echo "<th>" . $dias[$i] . "</th>\n";
			}
			echo "</tr>\n";

			// Una fila por cada hora
			for ($hora = 1; $hora <= 7; $hora++) {
				echo "<tr>\n";
				echo "<td>" . $franjas[$hora - 1] . "</td>\n";

				// Una celda por cada día
				for ($dia = 1; $dia <= 5; $dia++) {
					if (isset($horario[$dia][$hora])) {
						$asignatura = $horario[$dia][$hora];
						echo "<td class=\"" . $colores[$asignatura] . "\">" . $asignatura . "</td>\n";
					} else {
						echo "<td></td>\n";
					}
				}

				echo "</tr>\n";

				// El recreo va después de la 3ª hora
				if ($hora == 3) {
					echo "<tr>\n";
					echo "<td>11:00 - 11:30</td>\n";
					echo "<td class=\"recreo\" colspan=\"5\">RECREO</td>\n";
					echo "</tr>\n";
				}
			}
			?>
		</table>

		<a href="index.php?controlador=cAsignatura&accion=alta&clase=<?php echo $this->clase; ?>" class="botonAlta">Alta de horario</a>
		<a href="index.php?controlador=cAsignatura&accion=baja&clase=<?php echo $this->clase; ?>" class="botonBaja">Baja de horario</a>
	</main>
</body>

</html>