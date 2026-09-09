<?php
include_once __DIR__ . "/../modelos/BD.php";
include_once __DIR__ . "/../modelos/Matricula.php";
include_once __DIR__ . "/../modelos/Estudiantes.php";
include_once __DIR__ . "/../modelos/Cursos.php";

class ControladorMatricula {
 
    public function inicio()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare(
            "SELECT matricula.*, estudiantes.nombres, estudiantes.apellidos
             FROM matricula
             JOIN estudiantes ON matricula.id_estudiante = estudiantes.id
             ORDER BY matricula.fecha_matricula DESC"
        );
        $consulta->execute();
 
        $listaMatriculas = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $nombreEstudiante = $fila["nombres"] . " " . $fila["apellidos"];
 
            $consultaDet = $conexion->prepare(
                "SELECT cursos.nombre_curso
                 FROM detalle_matricula
                 JOIN cursos ON detalle_matricula.id_curso = cursos.id
                 WHERE detalle_matricula.id_matricula = ?"
            );
            $consultaDet->execute([$fila["id"]]);
            $cursos = $consultaDet->fetchAll(PDO::FETCH_COLUMN);
 
            $listaMatriculas[] = new Matricula(
                $fila["id"], $fila["id_estudiante"], $fila["fecha_matricula"],
                $fila["total_creditos"], $fila["estado"], $nombreEstudiante, $cursos
            );
        }
 
        require_once("./vistas/matricula/inicio.php");
    }
 
    public function crear()
    {
        $conexion = BD::crearInstancia();
 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idEstudiante = $_POST["id_estudiante"];
            $cursosSeleccionados = $_POST["cursos"] ?? [];
 
            try {
                $conexion->beginTransaction();
 
                // 1. Cabecera, con total_creditos en 0 por ahora
                $consulta = $conexion->prepare(
                    "INSERT INTO matricula
                     (id_estudiante, fecha_matricula, total_creditos, estado)
                     VALUES (?, ?, 0, 'matriculado')"
                );
                $consulta->execute([$idEstudiante, date("Y-m-d")]);
                $idMatricula = $conexion->lastInsertId();
 
                // 2. Una línea de detalle por cada curso elegido
                $totalCreditos = 0;
                foreach ($cursosSeleccionados as $idCurso) {
                    $consultaCurso = $conexion->prepare(
                        "SELECT creditos FROM cursos WHERE id=?"
                    );
                    $consultaCurso->execute([$idCurso]);
                    $creditosCurso = $consultaCurso->fetchColumn();
 
                    $consultaDetalle = $conexion->prepare(
                        "INSERT INTO detalle_matricula
                         (id_matricula, id_curso, creditos)
                         VALUES (?, ?, ?)"
                    );
                    $consultaDetalle->execute(
                        [$idMatricula, $idCurso, $creditosCurso]
                    );
 
                    $totalCreditos += $creditosCurso;
                }
 
                // 3. Ahora sí, el total real en la cabecera
                $consultaTotal = $conexion->prepare(
                    "UPDATE matricula SET total_creditos=? WHERE id=?"
                );
                $consultaTotal->execute([$totalCreditos, $idMatricula]);
 
                $conexion->commit();
                header("Location: ./?controlador=matricula&accion=inicio");
 
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "No se guardó la matrícula, ocurrió un error: " . $e->getMessage();
            }
        } else {
            $consulta = $conexion->prepare("SELECT * FROM estudiantes ORDER BY apellidos");
            $consulta->execute();
            $listaEstudiantes = [];
            $claseEstudiante = class_exists('Estudiantes') ? 'Estudiantes' : (class_exists('Estudiante') ? 'Estudiante' : 'Estudiantes');
            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $listaEstudiantes[] = new $claseEstudiante(
                    $fila["id"], $fila["nombres"], $fila["apellidos"],
                    $fila["direccion"], $fila["telefono"], $fila["email"], $fila["foto"]
                );
            }

            $consulta2 = $conexion->prepare("SELECT * FROM cursos ORDER BY nombre_curso");
            $consulta2->execute();
            $listaCursos = [];
            $claseCurso = class_exists('Cursos') ? 'Cursos' : 'Curso';
            while ($fila2 = $consulta2->fetch(PDO::FETCH_ASSOC)) {
                $listaCursos[] = new $claseCurso(
                    $fila2["id"], $fila2["nombre_curso"],
                    $fila2["creditos"], $fila2["id_profesor"]
                );
            }
 
            require_once("./vistas/matricula/crear.php");
        }
    }
 
    public function eliminar()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("DELETE FROM matricula WHERE id=?");
        $consulta->execute([$_GET["id"]]);
 
        header("Location: ./?controlador=matricula&accion=inicio");
    }
}