<?php
$registroActual = $registroNotas ?? null;
$promedioActual = $registroActual ? (float) $registroActual['promedio_final'] : 0;
$estadoActual = $registroActual['estado'] ?? 'en curso';
?>

<div class="container mt-4">
    <h2>Registrar calificación</h2>

    <div class="card mb-4">             //htmlspecialchars es una función de PHP que se utiliza
                                        //para convertir caracteres especiales en entidades HTML.
        <div class="card-body">
            <h5 class="card-title">   
                <?php echo htmlspecialchars(($alumno['nombres'] ?? '') . ' ' . ($alumno['apellidos'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
            </h5>
            <p class="card-text mb-0">
                Curso:
                <strong><?php echo htmlspecialchars($alumno['nombre_curso'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
            </p>
        </div>
    </div>

    <form method="POST" action="index.php?controlador=notas&accion=guardar" class="card p-4 mb-4">
        <input type="hidden" name="id_detalle_matricula"
            value="<?php echo (int) ($idDetalleMatricula ?? 0); ?>">

        <div class="mb-3">
            <label for="tipo_evaluacion" class="form-label">Tipo de evaluación:</label>
            <input type="text" id="tipo_evaluacion" name="tipo_evaluacion"
                class="form-control" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">Nota:</label>
            <input type="number" id="nota" name="nota"
                class="form-control" min="0" max="20" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso (%):</label>
            <input type="number" id="peso" name="peso"
            class="form-control" min="0.01" max="100" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="fecha_evaluacion" class="form-label">Fecha:</label>
            <input type="date" id="fecha_evaluacion" name="fecha_evaluacion"
            class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar calificación</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
    </form>

    <div class="card mb-4">
        <div class="card-body">
            <h4>Promedio actual</h4>
            <p class="mb-1"><strong><?php echo number_format($promedioActual, 2); ?></strong> / 20</p>
            <p class="mb-0">Estado: <strong><?php echo htmlspecialchars($estadoActual, ENT_QUOTES, 'UTF-8'); ?></strong></p>
        </div>
    </div>

    <h4>Evaluaciones registradas</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tipo de evaluación</th>
                    <th>Nota</th>
                    <th>Peso (%)</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($notas)): ?>
                    <?php foreach ($notas as $notaRegistrada): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($notaRegistrada['tipo_evaluacion'], ENT_QUOTES, 'UTF-8'); ?></td>  
                            <td><?php echo number_format((float)$notaRegistrada['nota'], 2); ?></td>
                            <td><?php echo number_format((float)$notaRegistrada['peso'], 2); ?>%</td>
                            <td><?php echo htmlspecialchars($notaRegistrada['fecha_evaluacion'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Todavía no hay evaluaciones registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
