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

    public function comprobar($correo, $contrasena)
    {
        $sql = "SELECT idUsuario, correo, rol
                FROM usuarios
                WHERE correo = '$correo'
                AND `contraseña` = '$contrasena'";

        $resultado = $this->conexion->query($sql);

        return $resultado->fetch_assoc();
    }
}