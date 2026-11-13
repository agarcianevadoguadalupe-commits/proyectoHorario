<?php
// Carga el modelo que va a usar.
require "Modelo/mHorario.php";

class cHorario
{
	// Archivo de la vista que lanzará el index al terminar la acción
	public $vista = "";

	// Datos que usa la vista
	// Por defecto 2DAW porque no está programada la vista de clases.
	public $clase = "2DAW";
	public $horario = array();
	public $error = "";

	// Mensajes de error por si la clase no existe (no se usa sin la vista de clases)
	private $errorClase = "La clase no existe";

	// Lista de clases permitidas (En el código completo serían las que se leerían de la BDD)
	// (Existen en la base de datos pero no hay un CRUD de clases)
	private $clases = array("1DAW", "1SMR", "2DAW", "2SMR");

	// Objetod el modelo
	private $modelo;

	public function __construct()
	{
		$this->modelo = new mHorario();
	}

	// Carga el archivo de vista en $vista (mejor la versión de esto en el index)
	/*public function mostrar()
	{
		require "Vista/" . $this->vista;
	}*/

	// Si llega una clase por GET comprueba que esté en la lista, si es válida la guarda (siempre lo será).
	// Luego pide el horario y apunta vHorario.php como vista.
	public function ver()
	{
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
