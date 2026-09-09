<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Profesores</title>
</head>
<body>

<h2 class="mt-4 mb-3">Listado de Profesores</h2>

<a href="?controlador=profesores&accion=crear" class="btn btn-success mb-3">➕ Nuevo Profesor</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Especialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach (($listaProfesores ?? []) as $profesor) { ?>
            <tr>
                <td><?php echo $profesor->getId(); ?></td>
                <td><?php echo $profesor->getNombres(); ?></td>
                <td><?php echo $profesor->getApellidos(); ?></td>
                <td><?php echo $profesor->getEspecialidad(); ?></td>
                <td>
                    <a href="?controlador=profesores&accion=editar&id=<?php echo $profesor->getId(); ?>"
                    class="btn btn-warning btn-sm">✏️ Editar</a>

                    <a href="?controlador=profesores&accion=eliminar&id=<?php echo $profesor->getId(); ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Seguro que deseas eliminar a este profesor?');">🗑️ Eliminar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>