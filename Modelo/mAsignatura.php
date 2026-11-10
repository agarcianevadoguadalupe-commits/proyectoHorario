<?php
// Carga la clase conexión
require "conexionDB.php";
class mAsignatura
{
	private $conexion;

	public function __construct()
	{
		$objetoConexion = new Conexion();
		$this->conexion = $objetoConexion->conectar();
	}

	// Hace un SELECT de nombre y profesor de las asignaturas de esa clase
	// ordenadas por nombre, mete cada fila en $asignaturas y devuelve la lista.
	public function obtenerAsignaturas($clase)
	{
		$sql = "SELECT nombre, profesor FROM asignatura WHERE clase = '" . $clase . "' ORDER BY nombre";
		$resultado = $this->conexion->query($sql);

		$asignaturas = array();
		while ($fila = $resultado->fetch_assoc()) {
			$asignaturas[] = $fila;
		}
		return $asignaturas;
	}

	// JOIN entre horario y asignatura para devolver la asignatura de ese hueco con su profesor.
	// Solo devuelve una fila o NULL.
	public function obtenerUna($clase, $dia, $hora)
	{
		$sql = "SELECT h.asignatura, a.profesor FROM horario h INNER JOIN asignatura a ON h.clase = a.clase AND h.asignatura = a.nombre WHERE h.clase = '" . $clase . "' AND h.dia = " . $dia . " AND h.hora = " . $hora;
		$resultado = $this->conexion->query($sql);
		return $resultado->fetch_assoc();
	}

	// Hace el INSERT en horario (BDD), devuelve false si falla para que salte el error.
	public function guardar($clase, $dia, $hora, $asignatura)
	{
		$sql = "INSERT INTO horario (clase, dia, hora, asignatura) VALUES ('" . $clase . "', " . $dia . ", " . $hora . ", '" . $asignatura . "')";
		try {
			return $this->conexion->query($sql);
		} catch (Exception $e) {
			return false;
		}
	}

	// Hace el DELETE del hueco indicado. No devuelve nada.
	public function borrar($clase, $dia, $hora)
	{
		$sql = "DELETE FROM horario WHERE clase = '" . $clase . "' AND dia = " . $dia . " AND hora = " . $hora;
		$this->conexion->query($sql);
	}
}
