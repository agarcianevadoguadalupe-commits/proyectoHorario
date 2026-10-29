<?php
    class Horario {
        private $conexion;

        public function __construct() {
            require "conexionDB.php";
            $this->conexion = $conexion;
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

        public function guardar($clase, $dia, $hora, $asignatura, $profesor) {
            $sql = "INSERT INTO horario (clase, dia, hora, asignatura, profesor) VALUES ('" . $clase . "', " . $dia . ", " . $hora . ", '" . $asignatura . "', '" . $profesor . "')";
            try {
                return $this->conexion->query($sql);
            } catch (Exception $e) {
                return false;
            }
        }
    }
?>