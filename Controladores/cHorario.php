<?php
// Carga el modelo que va a usar.
require "Modelo/mHorario.php";

class cHorario
{
	// Archivo de la vista que lanzará el index al terminar el método
	public $vista = "";

	// Mensajes de error por si la clase no existe (no se usa sin la vista de clases)
	private $errorClase = "La clase no existe";

	// Lista de clases permitidas (En el código completo serían las que se leerían de la BDD)
	// (Existen en la base de datos pero no hay un CRUD de clases)
	private $clases = array("1DAW", "1SMR", "2DAW", "2SMR");

	// Objeto del modelo
	private $modelo;

	public function __construct()
	{
		$this->modelo = new mHorario();
	}

	// Crea el array $datos con la clase por defecto (2DAW porque no está programada la vista de clases).
	// Si llega una clase por GET comprueba que esté en la lista, si es válida la guarda (siempre lo será).
	// Luego pide el horario, apunta vHorario.php como vista y devuelve $datos.
	public function ver()
	{
		$this->vista = "vHorario.php";

		$datos = array(
			"clase" => "2DAW",
			"horario" => array(),
			"error" => ""
		);

		if (isset($_GET["clase"])) {
			if (in_array($_GET["clase"], $this->clases)) {
				$datos["clase"] = $_GET["clase"];
			} else {
				$datos["error"] = $this->errorClase;
			}
		}

		$datos["horario"] = $this->modelo->obtener($datos["clase"]);

		return $datos;
	}
}