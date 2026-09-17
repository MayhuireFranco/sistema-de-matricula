<?php

require_once __DIR__ . "/../modelos/Cursos.php";
require_once __DIR__ . "/../modelos/Profesores.php";
require_once __DIR__ . "/../modelos/BD.php";

class ControladorCursos
{
    public function inicio()
    {
        $conexion = BD::crearInstancia();

        $sql = "SELECT c.*, CONCAT(p.nombres, ' ', p.apellidos) AS nombre_profesor
                FROM cursos c
                INNER JOIN profesores p ON c.id_profesor = p.id";
        $params = [];

        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente') {
            $sql .= " WHERE c.id_profesor = ?";
            $params[] = $_SESSION['idProfesor'];
        }

        $sql .= " ORDER BY c.nombre_curso";
        $consulta = $conexion->prepare($sql);
        $consulta->execute($params);

        $listaCursos = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $listaCursos[] = new Curso(
                $fila['id'],
                $fila['nombre_curso'],
                $fila['creditos'],
                $fila['id_profesor']
            );
        }

        require_once __DIR__ . "/../vistas/Cursos/inicio.php";
    }

    public function crear()
    {
        $conexion = BD::crearInstancia();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
            $consulta = $conexion->prepare(
                "INSERT INTO cursos (nombre_curso, creditos, id_profesor)
                VALUES (?, ?, ?)"
            );
            $consulta->execute([
                $_POST['nombre_curso'],
                $_POST['creditos'],
                $_POST['id_profesor']
            ]);

            header("Location: index.php?controlador=cursos&accion=inicio");
            exit;
        }

        $consulta = $conexion->prepare(
            "SELECT * FROM profesores ORDER BY apellidos"
        );
        $consulta->execute();
        $listaProfesores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . "/../vistas/Cursos/crear.php";
    }

    public function editar()
    {
        $conexion = BD::crearInstancia();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consulta = $conexion->prepare(
                "UPDATE cursos SET nombre_curso=?, creditos=?, id_profesor=?
                WHERE id=?"
            );
            $consulta->execute([
                $_POST['nombre_curso'],
                $_POST['creditos'],
                $_POST['id_profesor'],
                $_POST['id']
            ]);

            header("Location: index.php?controlador=cursos&accion=inicio");
            exit;
        }

        $consulta = $conexion->prepare("SELECT * FROM cursos WHERE id=?");
        $consulta->execute([$_GET['id']]);
        $fila = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$fila) {
            exit('Curso no encontrado.');
        }

        $curso = new Curso(
            $fila['id'],
            $fila['nombre_curso'],
            $fila['creditos'],
            $fila['id_profesor']
        );

        $consulta = $conexion->prepare(
            "SELECT * FROM profesores ORDER BY apellidos"
        );
        $consulta->execute();
        $listaProfesores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . "/../vistas/Cursos/editar.php";
    }

    public function eliminar()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("DELETE FROM cursos WHERE id=?");
        $consulta->execute([$_GET['id']]);

        header("Location: index.php?controlador=cursos&accion=inicio");
        exit;
    }

    public function verAlumnos()
    {
        $idCurso = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$idCurso) {
            exit('Falta el ID del curso.');
        }

        $conexion = BD::crearInstancia();

        $consultaCurso = $conexion->prepare(
            "SELECT id, nombre_curso, id_profesor FROM cursos WHERE id = ?"
        );
        $consultaCurso->execute([$idCurso]);
        $curso = $consultaCurso->fetch(PDO::FETCH_ASSOC);

        if (!$curso) {
            exit('Curso no encontrado.');
        }

        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente'
            && (int)$curso['id_profesor'] !== (int)$_SESSION['idProfesor']) {
            header('Location: index.php?controlador=cursos&accion=inicio');
            exit();
        }

        $consulta = $conexion->prepare(
            "SELECT dm.id AS id_detalle, e.nombres, e.apellidos
            FROM detalle_matricula dm
            JOIN matricula m ON dm.id_matricula = m.id
            JOIN estudiantes e ON m.id_estudiante = e.id
            WHERE dm.id_curso = ?
            ORDER BY e.apellidos, e.nombres"
        );
        $consulta->execute([$idCurso]);
        $listaAlumnos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . "/../vistas/Cursos/ver_alumnos.php";
    }
}
