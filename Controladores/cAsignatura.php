<?php
require "Modelo/mAsignatura.php";

class cAsignatura {
	// Archivo de la vista que lanzará el index al terminar la acción
	public $vista = "";

	// Datos que usan las vistas
	public $clase = "2DAW";
	public $dia = 1;
	public $hora = 1;
	public $asignaturas = array();
	public $fila = null;
	public $boton = "";
	public $error = "";

	// Mensajes de error
	private $errorDatos = "Faltan datos en el formulario";
	private $errorClase = "La clase no existe";
	private $errorDia = "El día no es válido";
	private $errorHora = "La hora no es válida para ese día";
	private $errorAsignatura = "La asignatura no es válida para esa clase";
	private $errorDuplicado = "Ya existe una asignatura a esa hora ese día";
	private $errorNoHay = "No hay ninguna asignatura a esa hora ese día";

	private $clases = array("1DAW", "1SMR", "2DAW", "2SMR");
	private $modelo;

	public function __construct() {
		$this->modelo = new mAsignatura();
	}

	public function mostrar() {
		require "Vista/" . $this->vista;
	}

	// Muestra el formulario de alta
	public function alta() {
		$this->cargarDatos($_GET);
		$this->asignaturas = $this->modelo->obtenerAsignaturas($this->clase);
		$this->vista = "vAltaHorario.php";
	}

	// Guarda la asignatura en el horario
	public function guardar() {
		// Si algo falla se vuelve a mostrar el formulario de alta
		$this->vista = "vAltaHorario.php";

		$this->cargarDatos($_POST);
		$this->asignaturas = $this->modelo->obtenerAsignaturas($this->clase);

		if ($this->error != "") {
			return;
		}

		if ($this->llegaronDatos() == false) {
			$this->error = $this->errorDatos;
			return;
		}

		// La asignatura tiene que ser una de las de esa clase
		$asignatura = "";
		if (isset($_POST["asignatura"])) {
			$asignatura = $_POST["asignatura"];
		}

		$existe = false;
		for ($i = 0; $i < count($this->asignaturas); $i++) {
			if ($this->asignaturas[$i]["nombre"] == $asignatura) {
				$existe = true;
			}
		}

		if ($existe == false) {
			$this->error = $this->errorAsignatura;
			return;
		}

		$correcto = $this->modelo->guardar($this->clase, $this->dia, $this->hora, $asignatura);

		if ($correcto == false) {
			$this->error = $this->errorDuplicado;
			return;
		}

		if (isset($_POST["boton"]) && $_POST["boton"] == "Guardar y siguiente") {
			$this->siguiente("alta");
		} else {
			header("Location: index.php?controlador=cHorario&accion=ver&clase=" . $this->clase);
			exit;
		}
	}

	// Muestra el formulario de baja (y la confirmación si se ha pulsado un botón)
	public function baja() {
		$this->vista = "vBajaHorario.php";

		$this->cargarDatos($_GET);

		if ($this->error != "") {
			return;
		}

		if (isset($_GET["boton"])) {
			$this->boton = "Borrar";
			if ($_GET["boton"] == "Borrar y siguiente") {
				$this->boton = "Borrar y siguiente";
			}

			$this->fila = $this->modelo->obtenerUna($this->clase, $this->dia, $this->hora);

			if ($this->fila == null) {
				$this->error = $this->errorNoHay;
			}
		}
	}

	// Borra la asignatura del horario
	public function borrar() {
		// Si algo falla se vuelve a mostrar el formulario de baja
		$this->vista = "vBajaHorario.php";

		$this->cargarDatos($_POST);

		if ($this->error != "") {
			return;
		}

		if ($this->llegaronDatos() == false) {
			$this->error = $this->errorDatos;
			return;
		}

		$this->modelo->borrar($this->clase, $this->dia, $this->hora);

		if (isset($_POST["boton"]) && $_POST["boton"] == "Borrar y siguiente") {
			$this->siguiente("baja");
		} else {
			header("Location: index.php?controlador=cHorario&accion=ver&clase=" . $this->clase);
			exit;
		}
	}

	// Lee clase, día y hora de $_GET o $_POST y los valida.
	// Si algo falla guarda el mensaje en $this->error y se queda con los valores por defecto
	private function cargarDatos($datos) {
		$this->error = "";

		if (isset($datos["clase"])) {
			if (in_array($datos["clase"], $this->clases) == false) {
				$this->error = $this->errorClase;
				return;
			}
			$this->clase = $datos["clase"];
		}

		if (isset($datos["dia"])) {
			$dia = (int) $datos["dia"];
			if ($dia < 1 || $dia > 5) {
				$this->error = $this->errorDia;
				return;
			}
			$this->dia = $dia;
		}

		if (isset($datos["hora"])) {
			$hora = (int) $datos["hora"];
			if ($hora < 1 || $hora > $this->ultimaHora($this->dia)) {
				$this->error = $this->errorHora;
				return;
			}
			$this->hora = $hora;
		}
	}

	// Comprueba que el formulario ha enviado clase, día y hora
	private function llegaronDatos() {
		return isset($_POST["clase"]) && isset($_POST["dia"]) && isset($_POST["hora"]);
	}

	// El lunes hay 7 horas y el resto de días 6
	private function ultimaHora($dia) {
		if ($dia == 1) {
			return 7;
		}
		return 6;
	}

	// Pasa a la hora siguiente y vuelve a la misma acción (alta o baja)
	private function siguiente($accion) {
		$dia = $this->dia;
		$hora = $this->hora + 1;

		if ($hora > $this->ultimaHora($dia)) {
			$hora = 1;
			$dia = $dia + 1;
		}

		if ($dia > 5) {
			header("Location: index.php?controlador=cHorario&accion=ver&clase=" . $this->clase);
		} else {
			header("Location: index.php?controlador=cAsignatura&accion=" . $accion . "&clase=" . $this->clase . "&dia=" . $dia . "&hora=" . $hora);
		}
		exit;
	}
}

?>