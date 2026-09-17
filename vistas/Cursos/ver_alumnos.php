<h3 class="mt-4">
    Alumnos matriculados en: <?php echo $curso['nombre_curso'] ?? ''; ?>
</h3>
 
<div class="table-responsive mt-3">
    <table class="table border">
        <thead>
            <tr>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($listaAlumnos ?? []) as $alumno) { ?>  
                <tr>
                    <td><?php echo $alumno['nombres']; ?></td>
                    <td><?php echo $alumno['apellidos']; ?></td>
                    <td>
                        <a href="index.php?controlador=notas&accion=calificar&id_detalle=<?php echo $alumno['id_detalle']; ?>"
                        class="btn btn-primary">Calificar</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
    </table>
</div>

