<?php
require_once "conexionDB.php";

class mSesion
{
    private $conexion;

    public function __construct()
    {
        $objetoConexion = new Conexion();
        $this->conexion = $objetoConexion->conectar();
        $this->conexion->set_charset("utf8mb4");
    }

    public function obtenerPorCorreo($correo)
    {
        $sql = "SELECT idUsuario, correo, `contraseña`, rol
                FROM usuarios
                WHERE correo = ?";

        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param("s", $correo);
        $consulta->execute();

        $usuario = $consulta->get_result()->fetch_assoc();
        $consulta->close();

        return $usuario;
    }
}
