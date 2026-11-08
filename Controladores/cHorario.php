<?php
require "Modelo/mHorario.php";

class cHorario {
	// Archivo de la vista que lanzará el index al terminar la acción
	public $vista = "";

	// Datos que usa la vista
	public $clase = "2DAW";
	public $horario = array();
	public $error = "";

	// Mensajes de error
	private $errorClase = "La clase no existe";

	private $clases = array("1DAW", "1SMR", "2DAW", "2SMR");
	private $modelo;

	public function __construct() {
		$this->modelo = new mHorario();
	}

	public function mostrar() {
		require "Vista/" . $this->vista;
	}

	public function ver() {
		if (isset($_GET["clase"])) {
			if (in_array($_GET["clase"], $this->clases)) {
				$this->clase = $_GET["clase"];
			} else {
				$this->error = $this->errorClase;
			}
		}

		$this->horario = $this->modelo->obtener($this->clase);
		$this->vista = "vHorario.php";
	}
}

?>