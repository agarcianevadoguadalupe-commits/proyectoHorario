<?php
require "Controladores/cAsignatura.php";

$objeto = new cAsignatura();    // Crear objeto
$objeto->guardar();             // LLamar al metodo
$objeto->mostrar();             // Incluir la vista
?>