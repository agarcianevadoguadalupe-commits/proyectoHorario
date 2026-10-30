<?php
class Conexion {
	public function conectar() {
		$conexion = new mysqli("esvirgua.com", "user1daw_10", "sh9Wz%65^^(_JAwW", "user1daw_BD1-10");
		return $conexion;
	}
}
?>