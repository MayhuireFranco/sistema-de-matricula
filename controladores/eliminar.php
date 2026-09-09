<?php



require_once "../modelos/Estudiantes.php";


if (isset($_GET['id'])) {

    $id = $_GET['id'];


    $estudiante = new Estudiante();

    $estudiante->setId($id);

    $estudiante->eliminar();
}


header("Location: listado.php");

exit();