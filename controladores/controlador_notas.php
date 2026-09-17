<?php

require_once __DIR__ . "/../modelos/RegistroNotas.php";
require_once __DIR__ . "/../modelos/DetalleNotas.php";
require_once __DIR__ . "/../modelos/BD.php";

class ControladorNotas
{
    public function calificar($idDetalleMatricula = null)
    {

        if ($idDetalleMatricula === null) {
            $idDetalleMatricula = filter_input(INPUT_GET, 'id_detalle', FILTER_VALIDATE_INT); // Filtrar datos
        }

        if (!$idDetalleMatricula || $idDetalleMatricula <= 0) {
            exit('Falta el ID del detalle de matrícula.');
        }

        $conexion = BD::crearInstancia();

        $idDetalleMatricula = intval($idDetalleMatricula); //convierte un valor a un número entero.

        // Busca alumno y curso
        $consulta = $conexion->prepare("                   
            SELECT 
                dm.id AS id_detalle,
                e.nombres,
                e.apellidos,
                c.nombre_curso
            FROM detalle_matricula dm
            INNER JOIN matricula m ON dm.id_matricula = m.id
            INNER JOIN estudiantes e ON m.id_estudiante = e.id
            INNER JOIN cursos c ON dm.id_curso = c.id
            WHERE dm.id = ?
        ");

        $consulta->execute([$idDetalleMatricula]);

        $alumno = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$alumno) {
            die("No se encontró el detalle de matrícula.");
        }

        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente') {
            $owner = $conexion->prepare(
                "SELECT c.id_profesor
                 FROM detalle_matricula dm
                 INNER JOIN cursos c ON dm.id_curso = c.id
                 WHERE dm.id = ?"
            );
            $owner->execute([$idDetalleMatricula]);
            if ((int)$owner->fetchColumn() !== (int)$_SESSION['idProfesor']) {
                header('Location: index.php?controlador=cursos&accion=inicio');
                exit();
            }
        }

        $consultaRegistro = $conexion->prepare("
            SELECT *
            FROM registro_notas
            WHERE id_detalle_matricula = ?
        ");

        $consultaRegistro->execute([$idDetalleMatricula]);

        $registroNotas = $consultaRegistro->fetch(PDO::FETCH_ASSOC);

        $notas = [];

        if ($registroNotas) {

            $consultaNotas = $conexion->prepare("
                SELECT *
                FROM detalle_notas
                WHERE id_registro_notas = ?
                ORDER BY fecha_evaluacion DESC
            ");

            $consultaNotas->execute([$registroNotas['id']]);

            $notas = $consultaNotas->fetchAll(PDO::FETCH_ASSOC);
        }

        //  vista.
        $idDetalleMatricula = $idDetalleMatricula;

        require __DIR__ . "/../vistas/notas/calificar.php";
    }


    public function guardar()
    {
        $conexion = BD::crearInstancia();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controlador=cursos&accion=inicio");
            exit;
        }

        $idDetalleMatricula = filter_input(INPUT_POST, 'id_detalle_matricula', FILTER_VALIDATE_INT); 
        $tipoEvaluacion = trim($_POST['tipo_evaluacion'] ?? '');
        $nota = filter_var($_POST['nota'] ?? null, FILTER_VALIDATE_FLOAT); // Filtra y valida la nota
        $peso = filter_var($_POST['peso'] ?? null, FILTER_VALIDATE_FLOAT);
        $fechaEvaluacion = $_POST['fecha_evaluacion'] ?? '';

        if (!$idDetalleMatricula || $idDetalleMatricula <= 0) {
            exit('ID de detalle de matrícula inválido.');
        }

        if ($tipoEvaluacion === '') {
            exit('El tipo de evaluación es obligatorio.');
        }

        if ($nota === false || $nota < 0 || $nota > 20) {
            exit('La nota debe estar entre 0 y 20.');
        }

        if ($peso === false || $peso <= 0 || $peso > 100) {
            exit('El peso debe ser mayor que 0 y no superar 100%.');
        }

        $fechaValida = DateTime::createFromFormat('Y-m-d', $fechaEvaluacion);
        if (!$fechaValida || $fechaValida->format('Y-m-d') !== $fechaEvaluacion) {
            exit('La fecha de evaluación no es válida.');
        }

        // Verificar que el docente solo pueda guardar notas de sus propios cursos.
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente') {
            $owner = $conexion->prepare(
                "SELECT c.id_profesor
                 FROM detalle_matricula dm
                 INNER JOIN cursos c ON dm.id_curso = c.id
                 WHERE dm.id = ?"
            );
            $owner->execute([$idDetalleMatricula]);
            if ((int)$owner->fetchColumn() !== (int)$_SESSION['idProfesor']) {
                header('Location: index.php?controlador=cursos&accion=inicio');
                exit();
            }
        }

        // Verificar que el detalle de matrícula realmente existe.
        $verificarDetalle = $conexion->prepare(
            "SELECT id FROM detalle_matricula WHERE id = ?"
        );
        $verificarDetalle->execute([$idDetalleMatricula]);
        if (!$verificarDetalle->fetchColumn()) {
            exit('El detalle de matrícula no existe.');
        }

        try {

            $conexion->beginTransaction();

            // 1. Buscar si ya existe registro_notas
            $consulta = $conexion->prepare("  
                SELECT id
                FROM registro_notas
                WHERE id_detalle_matricula = ?
                FOR UPDATE
            ");

            $consulta->execute([$idDetalleMatricula]);  

            $registro = $consulta->fetch(PDO::FETCH_ASSOC);

            // 2. Si no existe, crear cabecera
            if (!$registro) {

                $insertarRegistro = $conexion->prepare("
                    INSERT INTO registro_notas
                    (
                        id_detalle_matricula,
                        promedio_final,
                        estado
                    )
                    VALUES (?, 0, 'en curso')
                ");

                $insertarRegistro->execute([
                    $idDetalleMatricula
                ]);

                $idRegistroNotas = $conexion->lastInsertId();  

            } else {

                $idRegistroNotas = $registro['id'];
            }

            // 3. Verificar peso acumulado
            $consultaPeso = $conexion->prepare("
                SELECT COALESCE(SUM(peso), 0)
                FROM detalle_notas
                WHERE id_registro_notas = ?
            ");

            $consultaPeso->execute([$idRegistroNotas]);

            $pesoActual = floatval($consultaPeso->fetchColumn());  

            if (($pesoActual + $peso) > 100) {

                throw new Exception(
                    "El peso total de las evaluaciones no puede superar 100%. " .
                    "Actualmente tienes $pesoActual%."
                );
            }

            // 4. Insertar detalle
            $insertarNota = $conexion->prepare("
                INSERT INTO detalle_notas
                (
                    id_registro_notas,
                    tipo_evaluacion,
                    nota,
                    peso,
                    fecha_evaluacion
                )
                VALUES (?, ?, ?, ?, ?)
            ");

            $insertarNota->execute([
                $idRegistroNotas,
                $tipoEvaluacion,
                $nota,
                $peso,
                $fechaEvaluacion
            ]);

            // 5. Calcular promedio ponderado
            $consultaPromedio = $conexion->prepare("
                SELECT
                    COALESCE(SUM(nota * peso) / NULLIF(SUM(peso), 0), 0) AS promedio,
                    COALESCE(SUM(peso), 0) AS peso_total
                FROM detalle_notas
                WHERE id_registro_notas = ?
            ");

            $consultaPromedio->execute([$idRegistroNotas]);

            $resultado = $consultaPromedio->fetch(PDO::FETCH_ASSOC);

            $promedio = floatval($resultado['promedio']);
            $pesoTotal = floatval($resultado['peso_total']);

            // 6. Determinar estado
            if ($pesoTotal >= 100) {

                if ($promedio >= 10.5) {
                    $estado = "aprobado";
                } else {
                    $estado = "desaprobado";
                }

            } else {

                $estado = "en curso";
            }

            // 7. Actualizar registro
            $actualizar = $conexion->prepare("
                UPDATE registro_notas
                SET promedio_final = ?, estado = ?
                WHERE id = ?
            ");

            $actualizar->execute([  //es un método que ejecuta una sentencia preparada con los parámetros proporcionados.
                $promedio,
                $estado,
                $idRegistroNotas
            ]);

            $conexion->commit(); 

            // 8. Regresar a calificar
            header(
                "Location: index.php?controlador=notas&accion=calificar&id_detalle=" .
                $idDetalleMatricula
            );

            exit;

        } catch (Exception $e) {

            if ($conexion->inTransaction()) {
                $conexion->rollBack();
            }

            die("Error al guardar la calificación: " . $e->getMessage());
        }
    }
}