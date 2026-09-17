<?php

require_once __DIR__ . "/../modelos/Estudiantes.php";


class ControladorEstudiantes
{
    public function inicio()
    {
        $estudiante = new Estudiante();

        $estudiantes = $estudiante->consultarTodos();

        require_once __DIR__ . "/../vistas/estudiantes/inicio.php";
    }


    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            if (
                !isset($_FILES['foto']) ||
                $_FILES['foto']['name'] == ''
            ) {
                $nombreFoto = "sinfoto.png";
            } else {

                $extension = pathinfo(
                    $_FILES['foto']['name'],
                    PATHINFO_EXTENSION
                );

                $nombreFoto = time() . "_" . uniqid() . "." . $extension;

                $ruta = __DIR__ . "/../imagenes/" . $nombreFoto;

                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    $ruta
                );
            }

            $estudiante = new Estudiante(
                null,
                $nombres,
                $apellidos,
                $direccion,
                $telefono,
                $email,
                $nombreFoto
            );

            $estudiante->insertar();

            header("Location: index.php?controlador=estudiantes&accion=inicio");
exit();
        }

        require_once __DIR__ . "/../vistas/estudiantes/crear.php";
    }


    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            if (
                isset($_FILES['foto']) &&
                $_FILES['foto']['name'] != ''
            ) {

                $extension = pathinfo(
                    $_FILES['foto']['name'],
                    PATHINFO_EXTENSION
                );

                $nombreFoto = time() . "_" . uniqid() . "." . $extension;

                $ruta = __DIR__ . "/../imagenes/" . $nombreFoto;

                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    $ruta
                );

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

            header("Location: index.php?controlador=estudiantes&accion=inicio");
exit();
        }


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

        require_once __DIR__ . "/../vistas/estudiantes/editar.php";
    }


    public function eliminar()
    {
        $id = $_GET['id'];

        $estudiante = new Estudiante();

        $estudiante->setId($id);

        $estudiante->eliminar();

        header("Location: index.php?controlador=estudiantes&accion=inicio");
exit();
    }
}


