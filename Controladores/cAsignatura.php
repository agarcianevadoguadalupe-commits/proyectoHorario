<?php
// Carga el modelo que va a usar.
require "Modelo/mAsignatura.php";

class cAsignatura
{
	// Archivo de la vista que lanzará el index al terminar el método
	public $vista = "";

	// Mensajes de error (se podría usar un array pero me parece más conveniente así)
	private $errorDatos = "Faltan datos en el formulario";
	private $errorClase = "La clase no existe";
	private $errorDia = "El día no es válido";
	private $errorHora = "La hora no es válida para ese día";
	private $errorAsignatura = "La asignatura no es válida para esa clase";
	private $errorDuplicado = "Ya existe una asignatura a esa hora ese día";
	private $errorNoHay = "No hay ninguna asignatura a esa hora ese día";

	// Lista de clases permitidas.
	private $clases = array("1DAW", "1SMR", "2DAW", "2SMR");
	private $modelo;

	public function __construct()
	{
		$this->modelo = new mAsignatura();
	}

	// Carga y valida los datos del GET. Pide las asignaturas para el desplegable,
	// apunta vAltaHorario como vista y devuelve $datos
	public function alta()
	{
		$this->vista = "vAltaHorario.php";

		$datos = $this->cargarDatos($_GET);
		$datos["asignaturas"] = $this->modelo->obtenerAsignaturas($datos["clase"]);

		return $datos;
	}

	// Hace un INSERT de la asignatura seleccionada en la clase, día y hora seleccionados.
	// Si algo falla devuelve $datos con el error para mostrarlo en el formulario de alta.
	public function guardar()
	{
		// Apunta primero a la vista para mostrar el error en pantalla en cuyo caso.
		$this->vista = "vAltaHorario.php";

		// Carga y valida los datos que llegan del formulario.
		$datos = $this->cargarDatos($_POST);
		$datos["asignaturas"] = $this->modelo->obtenerAsignaturas($datos["clase"]);

		if ($datos["error"] != "") {
			return $datos;
		}

		// Comprueba que los datos llegaron
		if ($this->llegaronDatos() == false) {
			$datos["error"] = $this->errorDatos;
			return $datos;
		}

		$asignatura = "";
		if (isset($_POST["asignatura"])) {
			$asignatura = $_POST["asignatura"];
		}

		// Comprueba si la asignatura pertenece a la clase
		$existe = false;
		for ($i = 0; $i < count($datos["asignaturas"]); $i++) {
			if ($datos["asignaturas"][$i]["nombre"] == $asignatura) {
				$existe = true;
			}
		}

		if ($existe == false) {
			$datos["error"] = $this->errorAsignatura;
			return $datos;
		}

		$correcto = $this->modelo->guardar($datos["clase"], $datos["dia"], $datos["hora"], $asignatura);

		if ($correcto == false) {
			$datos["error"] = $this->errorDuplicado;
			return $datos;
		}

		// Si todo sale bien, comprueba si está seleccionado guardar y salir o siguiente.
		if (isset($_POST["boton"]) && $_POST["boton"] == "Guardar y siguiente") {
			$this->siguiente("alta", $datos);
		} else {
			header("Location: index.php?controlador=cHorario&metodo=ver&clase=" . $datos["clase"]);
			exit;
		}
	}

	// Muestra el formulario de baja (y la confirmación si se ha pulsado un botón)
	public function baja()
	{
		$this->vista = "vBajaHorario.php";

		$datos = $this->cargarDatos($_GET);

		if ($datos["error"] != "") {
			return $datos;
		}

		if (isset($_GET["boton"])) {
			$datos["boton"] = "Borrar";
			if ($_GET["boton"] == "Borrar y siguiente") {
				$datos["boton"] = "Borrar y siguiente";
			}

			$datos["fila"] = $this->modelo->obtenerUna($datos["clase"], $datos["dia"], $datos["hora"]);

			if ($datos["fila"] == null) {
				$datos["error"] = $this->errorNoHay;
			}
		}

		return $datos;
	}

	// Borra la asignatura del horario
	public function borrar()
	{
		// Si algo falla se vuelve a mostrar el formulario de baja
		$this->vista = "vBajaHorario.php";

		$datos = $this->cargarDatos($_POST);

		if ($datos["error"] != "") {
			return $datos;
		}

		if ($this->llegaronDatos() == false) {
			$datos["error"] = $this->errorDatos;
			return $datos;
		}

		$this->modelo->borrar($datos["clase"], $datos["dia"], $datos["hora"]);

		if (isset($_POST["boton"]) && $_POST["boton"] == "Borrar y siguiente") {
			$this->siguiente("baja", $datos);
		} else {
			header("Location: index.php?controlador=cHorario&metodo=ver&clase=" . $datos["clase"]);
			exit;
		}
	}

	// Crea el array $datos con los valores por defecto y lo rellena con la clase, día y hora
	// de $_GET o $_POST (que llegan en $entrada) ya validados.
	// Si algo falla guarda el mensaje en $datos["error"] y deja los valores por defecto.
	private function cargarDatos($entrada)
	{
		$datos = array(
			"clase" => "2DAW",
			"dia" => 1,
			"hora" => 1,
			"asignaturas" => array(),
			"fila" => null,
			"boton" => "",
			"error" => ""
		);

		if (isset($entrada["clase"])) {
			if (in_array($entrada["clase"], $this->clases) == false) {
				$datos["error"] = $this->errorClase;
				return $datos;
			}
			$datos["clase"] = $entrada["clase"];
		}

		if (isset($entrada["dia"])) {
			$dia = (int) $entrada["dia"];
			if ($dia < 1 || $dia > 5) {
				$datos["error"] = $this->errorDia;
				return $datos;
			}
			$datos["dia"] = $dia;
		}

		if (isset($entrada["hora"])) {
			$hora = (int) $entrada["hora"];
			if ($hora < 1 || $hora > $this->ultimaHora($datos["dia"])) {
				$datos["error"] = $this->errorHora;
				return $datos;
			}
			$datos["hora"] = $hora;
		}

		return $datos;
	}

	// Comprueba que el formulario ha enviado clase, día y hora
	private function llegaronDatos()
	{
		return isset($_POST["clase"]) && isset($_POST["dia"]) && isset($_POST["hora"]);
	}

	// El lunes hay 7 horas y el resto de días 6
	private function ultimaHora($dia)
	{
		if ($dia == 1) {
			return 7;
		}
		return 6;
	}

	// Pasa a la hora siguiente y vuelve al mismo método (alta o baja) usando el día, hora y clase de $datos
	private function siguiente($metodo, $datos)
	{
		$dia = $datos["dia"];
		$hora = $datos["hora"] + 1;

		if ($hora > $this->ultimaHora($dia)) {
			$hora = 1;
			$dia = $dia + 1;
		}

		if ($dia > 5) {
			header("Location: index.php?controlador=cHorario&metodo=ver&clase=" . $datos["clase"]);
		} else {
			header("Location: index.php?controlador=cAsignatura&metodo=" . $metodo . "&clase=" . $datos["clase"] . "&dia=" . $dia . "&hora=" . $hora);
		}
		exit;
	}
}