<?php
require "Controladores/cAsignatura.php";

$objeto = new cAsignatura();    // Crear objeto    
$objeto->alta();                // LLamar al metodo
$objeto->mostrar();             // Incluir la vista
?>