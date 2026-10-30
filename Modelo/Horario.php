<?php
    require "../conexionDB.php";

    class Horario {
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

                public function guardar($clase, $dia, $hora, $asignatura) {
            $sql = "INSERT INTO horario (clase, dia, hora, asignatura) VALUES ('" . $clase . "', " . $dia . ", " . $hora . ", '" . $asignatura . "')";
            try {
                return $this->conexion->query($sql);
            } catch (Exception $e) {
                return false;
            }
        }

        public function obtenerUna($clase, $dia, $hora) {
            $sql = "SELECT h.asignatura, a.profesor FROM horario h INNER JOIN asignatura a ON h.clase = a.clase AND h.asignatura = a.nombre WHERE h.clase = '" . $clase . "' AND h.dia = " . $dia . " AND h.hora = " . $hora;
            $resultado = $this->conexion->query($sql);
            return $resultado->fetch_assoc();
        }

        public function obtenerAsignaturas($clase) {
            $sql = "SELECT nombre, profesor FROM asignatura WHERE clase = '" . $clase . "' ORDER BY nombre";
            $resultado = $this->conexion->query($sql);

            $asignaturas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $asignaturas[] = $fila;
            }
            return $asignaturas;
        }

        public function borrar($clase, $dia, $hora) {
            $sql = "DELETE FROM horario WHERE clase = '" . $clase . "' AND dia = " . $dia . " AND hora = " . $hora;
            $this->conexion->query($sql);
        }
    }
?>