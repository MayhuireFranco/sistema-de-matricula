<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
</head>
<body>
<?php $curso = isset($curso) ? $curso : null; ?>
<?php $listaProfesores = isset($listaProfesores) && is_array($listaProfesores) ? $listaProfesores : []; ?>
<div class="container mt-5">
    <h2>Editar Curso</h2>
    <form method="POST" action="?controlador=cursos&accion=editar">
        <input type="hidden" name="id" value="<?php echo $curso?->getId() ?? ''; ?>">

        <div class="mb-3">
            <label>Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" 
            value="<?php echo $curso?->getNombreCurso() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" 
            value="<?php echo $curso?->getCreditos() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Profesor</label>
            <select name="id_profesor" class="form-control" required>
                <option value="">Seleccione un profesor</option>
                <?php foreach ($listaProfesores as $profesor) { ?>
                    <option value="<?php echo $profesor['id']; ?>"
                        <?php if ($profesor['id'] == ($curso?->getIdProfesor() ?? null)) echo "selected"; ?>>
                        <?php echo $profesor['nombres'] . ' ' . $profesor['apellidos']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="?controlador=cursos&accion=inicio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>