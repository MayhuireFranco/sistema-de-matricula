<?php


require_once "../modelos/Estudiantes.php";

$estudiante = new Estudiante();

$estudiantes = $estudiante->consultarTodos();

require_once "../vistas/listado.php";