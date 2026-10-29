<?php
require "../Modelo/Horario.php";

class HorarioControlador {
	private $modelo;

	public function __construct() {
		$this->modelo = new Horario();
	}

	public function ver($clase) {
		return $this->modelo->obtener($clase);
	}

	public function guardar() {
		$accion = $_POST["accion"];
		$clase = $_POST["clase"];
		$dia = $_POST["dia"];
		$hora = $_POST["hora"];

		$correcto = $this->modelo->guardar($clase, $dia, $hora, $_POST["asignatura"], $_POST["profesor"]);

		if ($accion == "Guardar y siguiente") {
			if ($correcto == false) {
				header("Location: ../Vista/altaHorario.php?clase=" . $clase . "&dia=" . $dia . "&hora=" . $hora . "&error=1");
				return;
			}
			
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
				header("Location: ../Vista/verHorario.php?clase=" . $clase);
			} else {
				header("Location: ../Vista/altaHorario.php?clase=" . $clase . "&dia=" . $dia . "&hora=" . $hora);
			}
		} else {
			header("Location: ../Vista/verHorario.php?clase=" . $clase);
		}
	}
}
?>