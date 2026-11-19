<?php
require_once "Modelo/mSesion.php";

class cSesion
{
    public $vista = "";

    public function iniciar()
    {
        $this->vista = "VLogIn.php";

        $datos = array(
            "correo" => "",
            "error" => ""
        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST["correo"] ?? "";
            $contrasena = $_POST["contrasena"] ?? "";

            if (!is_string($correo) || !is_string($contrasena)) {
                $datos["error"] = "Los datos introducidos no son válidos.";
                return $datos;
            }

            $datos["correo"] = trim($correo);

            if ($datos["correo"] === "" || $contrasena === "") {
                $datos["error"] = "Introduce el correo y la contraseña.";
                return $datos;
            }

            try {
                $modelo = new mSesion();
                $usuario = $modelo->obtenerPorCorreo($datos["correo"]);
            } catch (mysqli_sql_exception $e) {
                $datos["error"] = "No se ha podido consultar la base de datos.";
                return $datos;
            }

            if (!$usuario || $contrasena !== $usuario["contraseña"]) {
                $datos["error"] = "El correo o la contraseña son incorrectos.";
                return $datos;
            }

            session_regenerate_id(true);

            $_SESSION["id"] = $usuario["idUsuario"];
            $_SESSION["nombre"] = $usuario["correo"];
            $_SESSION["rol"] = $usuario["rol"];

            header("Location: index.php?controlador=cHorario&metodo=ver");
            exit;
        }

        return $datos;
    }

    public function cerrar()
    {
        session_unset();
        session_destroy();

        $this->vista = "vLogOut.php";

        return array();
    }
}
