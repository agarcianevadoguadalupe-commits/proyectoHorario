<?php
require "Controladores/cHorario.php";

$objeto = new cHorario();   // Crear objeto    
$objeto->ver();             // LLamar al metodo
require "Vista/" . $objeto->vista;       // Incluir la vista
