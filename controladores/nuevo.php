<?php


require_once "../modelos/Estudiantes.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];


    // FOTO

    if (
        !isset($_FILES['foto']) ||
        $_FILES['foto']['name'] == ''
    ) {

        $nombreFoto = 'sinfoto.png';

    } else {

        $extension = pathinfo(
            $_FILES['foto']['name'],
            PATHINFO_EXTENSION
        );

        $nombreFoto = time() . '_' . uniqid() . '.' . $extension; // Generar un nombre único para la foto

        $ruta = "../uploads/" . $nombreFoto;

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            $ruta
        );
    }


    // CREAR OBJETO

    $estudiante = new Estudiante(
        null,
        $nombres,
        $apellidos,
        $direccion,
        $telefono,
        $email,
        $nombreFoto
    );


    // INSERTAR

    $estudiante->insertar();


    // REGRESAR AL LISTADO

    header("Location: listado.php");

    exit();
}


require_once "../vistas/formulario_nuevo.php";