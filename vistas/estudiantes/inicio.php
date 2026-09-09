<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Estudiantes</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-4">

    <h1 class="mb-4">
        Lista de Estudiantes
    </h1>


    <a
        href="controlador_estudiantes.php?accion=crear"
        class="btn btn-primary mb-3"
    >
        Nuevo estudiante
    </a>


    <table class="table table-bordered table-striped">

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Acciones</th>

            </tr>

        </thead>


        <tbody>

            <?php foreach (($estudiantes ?? []) as $estudiante): ?>

                <tr>

                    <td>
                        <?php echo $estudiante->getId(); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(
                            $estudiante->getNombres()
                        ); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(
                            $estudiante->getApellidos()
                        ); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(
                            $estudiante->getDireccion()
                        ); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(
                            $estudiante->getTelefono()
                        ); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(
                            $estudiante->getEmail()
                        ); ?>
                    </td>

                    <td>

                        <img
                            src="../../imagenes/<?php echo htmlspecialchars($estudiante->getFoto()); ?>"
                            width="100"
                            height="100"
                            style="object-fit: cover;"
                            alt="Foto"
                        >

                    </td>

                    <td>

                        <a
                            href="controlador_estudiantes.php?accion=editar&id=<?php echo $estudiante->getId(); ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Editar
                        </a>


                        <a
                            href="controlador_estudiantes.php?accion=eliminar&id=<?php echo $estudiante->getId(); ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Está seguro de eliminar este estudiante?');"
                        >
                            Eliminar
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>

</html>