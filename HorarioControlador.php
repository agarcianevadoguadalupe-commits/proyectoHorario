<?php
require "Horario.php";

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

		$this->modelo->guardar($clase, $dia, $hora, $_POST["asignatura"], $_POST["profesor"]);

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
	}
}
?>