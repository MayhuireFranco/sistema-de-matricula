<?php

require_once "../modelos/Estudiantes.php";


// SI SE ENVIÓ EL FORMULARIO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $nombres = $_POST['nombres'];

    $apellidos = $_POST['apellidos'];

    $direccion = $_POST['direccion'];

    $telefono = $_POST['telefono'];

    $email = $_POST['email'];


    // ¿HAY UNA FOTO NUEVA?

    $hayFotoNueva =
        isset($_FILES['foto']) &&
        $_FILES['foto']['name'] != '';


    if ($hayFotoNueva) {

        $extension = pathinfo(
            $_FILES['foto']['name'],
            PATHINFO_EXTENSION
        );


        $nombreFoto =
            time() . '_' . uniqid() . '.' . $extension;


        $ruta =
            "../uploads/" . $nombreFoto;


        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            $ruta
        );


        // ACTUALIZAR INCLUYENDO FOTO

        $estudiante = new Estudiante(
            $id,
            $nombres,
            $apellidos,
            $direccion,
            $telefono,
            $email,
            $nombreFoto
        );


        $estudiante->actualizar(true);

    } else {

        // NO HAY FOTO NUEVA

        // IMPORTANTE:
        // La columna foto NO se modifica.

        $estudiante = new Estudiante(
            $id,
            $nombres,
            $apellidos,
            $direccion,
            $telefono,
            $email
        );


        $estudiante->actualizar(false);
    }


    header("Location: listado.php");

    exit();
}


// MOSTRAR FORMULARIO


$id = $_GET['id'];


$conexion = BD::crearInstancia();


$sql = "SELECT * FROM estudiantes WHERE id = :id";


$consulta = $conexion->prepare($sql);

$consulta->bindParam(':id', $id);

$consulta->execute();


$fila = $consulta->fetch(PDO::FETCH_ASSOC);


$estudiante = new Estudiante(
    $fila['id'],
    $fila['nombres'],
    $fila['apellidos'],
    $fila['direccion'],
    $fila['telefono'],
    $fila['email'],
    $fila['foto']
);


require_once "../vistas/formulario_editar.php";