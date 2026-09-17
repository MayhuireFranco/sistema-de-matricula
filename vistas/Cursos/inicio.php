<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cursos</title>
</head>
<body>
<div class="container mt-5">
    <h2>Listado de Cursos</h2>
    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
<a href="?controlador=cursos&accion=crear" class="btn btn-success mb-3">Nuevo Curso</a>
<?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre del Curso</th>
                <th>Créditos</th>
                <th>ID Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach (($listaCursos ?? []) as $curso) { ?>
            <tr>
                <td><?php echo $curso->getId(); ?></td>
                <td><?php echo $curso->getNombreCurso(); ?></td>
                <td><?php echo $curso->getCreditos(); ?></td>
                <td><?php echo $curso->getIdProfesor(); ?></td>
                <td>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <a href="?controlador=cursos&accion=editar&id=<?php echo $curso->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="?controlador=cursos&accion=eliminar&id=<?php echo $curso->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este curso?');">Eliminar</a>
                    <?php endif; ?>
                    <a href="?controlador=cursos&accion=verAlumnos&id=<?php echo $curso->getId(); ?>" class="btn btn-info btn-sm">Ver alumnos</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>