<?php
require "../Controlador/HorarioControlador.php";

// Franjas horarias (la hora 1 es la primera)
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

$controlador = new HorarioControlador();
$horario = $controlador->ver("2DAW");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Horario 2DAW</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <header class="cabecera">
            <a href="https://fundacionloyola.com/vguadalupe/" class="logoEVG">
                <img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png" alt="Logotipo EVG">
            </a>
            <nav class="menu">
                <a href="clases.php" class="activo">Clases</a>
            </nav>
            <a href="altaHorario.php" class="sesion">Iniciar sesión</a>
        </header>

	<main>
		<table>
			<?php
				// Fila de encabezado con los días
				echo "<tr>\n";
				echo "<th></th>\n";
				for ($i = 0; $i < 5; $i++) {
					echo "<th>" . $dias[$i] . "</th>\n";
				}
				echo "</tr>\n";
				?>
			<?php
			// Una fila por cada hora
			for ($hora = 1; $hora <= 7; $hora++) {
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

		<a href="altaHorario.php">Alta de horario</a>
	</main>

</body>
</html>