<?php
require "Controladores/cAsignatura.php";

$objeto = new cAsignatura();    // Crear objeto
$objeto->guardar();             // LLamar al metodo
require "Vista/" . $objeto->vista;         // Incluir la vista
?>