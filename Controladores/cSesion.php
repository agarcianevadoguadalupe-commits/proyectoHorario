<?php
require_once "Modelo/mSesion.php";

class cSesion
{
    public $vista = "";

    public function iniciar()
    {
        // La vista que mostrará el index
        $this->vista = "VLogIn.php";

        // Datos que necesita esa vista
        $datos = array(
            "correo" => "",
            "error" => ""
        );

        // Comprueba si se ha enviado el formulario
        if (isset($_POST["correo"], $_POST["contrasena"])) {
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];

            // Conserva el correo para mostrarlo si falla el login
            $datos["correo"] = $correo;

            // Pide al modelo que busque al usuario
            $modelo = new mSesion();
            $usuario = $modelo->comprobar($correo, $contrasena);

            if ($usuario) {
                // Cambia el identificador de la sesión al entrar
                session_regenerate_id(true);

                // Guarda los datos del usuario en la sesión
                $_SESSION["id"] = $usuario["idUsuario"];
                $_SESSION["nombre"] = $usuario["correo"];
                $_SESSION["rol"] = $usuario["rol"];

                // Vuelve al horario
                header("Location: index.php");
                exit;
            } else {
                $datos["error"] = "Correo o contraseña incorrectos.";
            }
        }

        return $datos;
    }

    public function cerrar()
    {
        // Vacía los datos y termina la sesión
        session_unset();
        session_destroy();

        $this->vista = "vLogOut.php";

        return array();
    }
}