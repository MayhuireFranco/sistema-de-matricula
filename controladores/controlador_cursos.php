<?php

require_once("./modelos/Cursos.php");
require_once("./modelos/Profesores.php");
require_once("./conexion.php");

class ControladorCursos {

    public function inicio()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("SELECT * FROM cursos ORDER BY nombre_curso");
        $consulta->execute();

        $listaCursos = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $listaCursos[] = new Curso($fila["id"], $fila["nombre_curso"], $fila["creditos"], $fila["id_profesor"]);
        }

        require_once("./vistas/cursos/inicio.php");
    }

    public function crear()
    {
        $conexion = BD::crearInstancia();


        $consulta = $conexion->prepare("SELECT * FROM profesores ORDER BY apellidos");
        $consulta->execute();
        $listaProfesores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $consulta = $conexion->prepare("INSERT INTO cursos (nombre_curso, creditos, id_profesor) VALUES (?, ?, ?)");
            $consulta->execute([$_POST["nombre_curso"], $_POST["creditos"], $_POST["id_profesor"]]);

            header("Location: ./?controlador=cursos&accion=inicio");
        } else {
            require_once("./vistas/cursos/crear.php");
        }
    }

    public function editar()
    {
        $conexion = BD::crearInstancia();

        // Traer profesores
        $consulta = $conexion->prepare("SELECT * FROM profesores ORDER BY apellidos");
        $consulta->execute();
        $listaProfesores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $consulta = $conexion->prepare("UPDATE cursos SET nombre_curso=?, creditos=?, id_profesor=? WHERE id=?");
            $consulta->execute([$_POST["nombre_curso"], $_POST["creditos"], $_POST["id_profesor"], $_POST["id"]]);

            header("Location: ./?controlador=cursos&accion=inicio");
        } else {
            $consulta = $conexion->prepare("SELECT * FROM cursos WHERE id=?");
            $consulta->execute([$_GET["id"]]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);
            $curso = new Curso($fila["id"], $fila["nombre_curso"], $fila["creditos"], $fila["id_profesor"]);

            require_once("./vistas/cursos/editar.php");
        }
    }
}