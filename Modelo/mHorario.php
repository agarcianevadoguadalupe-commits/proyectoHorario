<?php
require "conexionDB.php";

class mHorario {
	private $conexion;

	public function __construct() {
		$objetoConexion = new Conexion();
		$this->conexion = $objetoConexion->conectar();
	}

	public function obtener($clase) {
		$sql = "SELECT dia, hora, asignatura FROM horario WHERE clase = '" . $clase . "'";
		$resultado = $this->conexion->query($sql);

		$horario = array();
		while ($fila = $resultado->fetch_assoc()) {
			$horario[$fila["dia"]][$fila["hora"]] = $fila["asignatura"];
		}
		return $horario;
	}
}

?>