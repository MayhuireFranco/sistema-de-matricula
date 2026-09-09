<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Curso</title>
</head>
<body>
<div class="container mt-5">
    <h2>Nuevo Curso</h2>
    <form method="POST" action="?controlador=cursos&accion=crear">
        <div class="mb-3">
            <label>Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Profesor</label>
            <select name="id_profesor" class="form-control" required>
                <option value="">Seleccione un profesor</option>
                <?php foreach ($listaProfesores as $profesor) { ?>
                    <option value="<?php echo $profesor['id']; ?>">
                        <?php echo $profesor['nombres'] . ' ' . $profesor['apellidos']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="?controlador=cursos&accion=inicio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>