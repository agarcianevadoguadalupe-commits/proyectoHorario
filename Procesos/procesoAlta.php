<?php
require "Controladores/cAsignatura.php";

$objeto = new cAsignatura();    // Crear objeto    
$objeto->alta();                // LLamar al metodo
require "Vista/" . $objeto->vista;             // Incluir la vista
?>