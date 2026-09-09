<?php

require_once "../modelos/Estudiantes.php";
require_once "../modelos/BD.php";
require_once "../modelos/DetalleMatricula.php";
require_once "../modelos/Matricula.php";
require_once "../modelos/Curso.php";
require_once "../modelos/Profesor.php";
require_once "../modelos/Usuario.php";
require_once "../modelos/Administrador.php";


class ControladorEstudiantes
{


    public function inicio()
    {
        $estudiante = new Estudiante();

        $estudiantes = $estudiante->consultarTodos();

        require_once "../vistas/estudiantes/inicio.php";
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

                // Generar nombre único para la foto
                $nombreFoto =
                    time() . "_" . uniqid() . "." . $extension;

                // Ruta donde se guardará físicamente
                $ruta = "../imagenes/" . $nombreFoto;

                // Mover archivo
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


            // Volver al inicio

            header(
                "Location: controlador_estudiantes.php?accion=inicio"
            );

            exit();
        }


        require_once "../vistas/estudiantes/crear.php";
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

                $nombreFoto =
                    time() . "_" . uniqid() . "." . $extension;

                $ruta = "../imagenes/" . $nombreFoto;

                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    $ruta
                );


                // Crear objeto incluyendo foto

                $estudiante = new Estudiante(
                    $id,
                    $nombres,
                    $apellidos,
                    $direccion,
                    $telefono,
                    $email,
                    $nombreFoto
                );


                // true = actualizar también foto

                $estudiante->actualizar(true);

            } else {


                // Crear objeto sin foto
                $estudiante = new Estudiante(
                    $id,
                    $nombres,
                    $apellidos,
                    $direccion,
                    $telefono,
                    $email
                );


                // false = NO tocar la columna foto

                $estudiante->actualizar(false);
            }


            header(
                "Location: controlador_estudiantes.php?accion=inicio"
            );

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


        require_once "../vistas/estudiantes/editar.php";
    }



    public function eliminar()
    {
        $id = $_GET['id'];

        $estudiante = new Estudiante();

        $estudiante->setId($id);

        $estudiante->eliminar();


        header(
            "Location: controlador_estudiantes.php?accion=inicio"
        );

        exit();
    }
}




$controlador = new ControladorEstudiantes();

$accion = isset($_GET['accion'])
    ? $_GET['accion']
    : 'inicio';


switch ($accion) {

    case 'inicio':
        $controlador->inicio();
        break;

    case 'crear':
        $controlador->crear();
        break;

    case 'editar':
        $controlador->editar();
        break;

    case 'eliminar':
        $controlador->eliminar();
        break;

    default:
        $controlador->inicio();
        break;
}