<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cursos</title>
</head>
<body>
<div class="container mt-5">
    <h2>Listado de Cursos</h2>
    <a href="?controlador=cursos&accion=crear" class="btn btn-success mb-3">Nuevo Curso</a>

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
        <?php foreach ($listaCursos as $curso) { ?>
            <tr>
                <td><?php echo $curso->getId(); ?></td>
                <td><?php echo $curso->getNombreCurso(); ?></td>
                <td><?php echo $curso->getCreditos(); ?></td>
                <td><?php echo $curso->getIdProfesor(); ?></td>
                <td>
                    <a href="?controlador=cursos&accion=editar&id=<?php echo $curso->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>