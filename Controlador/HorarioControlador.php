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

	public function verUna($clase, $dia, $hora) {
		return $this->modelo->obtenerUna($clase, $dia, $hora);
	}

	public function verAsignaturas($clase) {
		return $this->modelo->obtenerAsignaturas($clase);
	}

	public function guardar() {
		$accion = $_POST["accion"];
		$clase = $_POST["clase"];
		$dia = $_POST["dia"];
		$hora = $_POST["hora"];

		$correcto = $this->modelo->guardar($clase, $dia, $hora, $_POST["asignatura"]);

		if ($correcto == false) {
			header("Location: ../Vista/altaHorario.php?clase=" . $clase . "&dia=" . $dia . "&hora=" . $hora . "&error=1");
			return;
		}

		if ($accion == "Guardar y siguiente") {
			$this->siguiente($clase, $dia, $hora, "altaHorario.php");
		} else {
			header("Location: ../Vista/verHorario.php?clase=" . $clase);
		}
	}

	public function borrar() {
		$accion = $_POST["accion"];
		$clase = $_POST["clase"];
		$dia = $_POST["dia"];
		$hora = $_POST["hora"];

		$this->modelo->borrar($clase, $dia, $hora);

		if ($accion == "Borrar y siguiente") {
			$this->siguiente($clase, $dia, $hora, "bajaHorario.php");
		} else {
			header("Location: ../Vista/verHorario.php?clase=" . $clase);
		}
	}

	private function siguiente($clase, $dia, $hora, $pagina) {
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
			header("Location: ../Vista/" . $pagina . "?clase=" . $clase . "&dia=" . $dia . "&hora=" . $hora);
		}
	}
}
?>