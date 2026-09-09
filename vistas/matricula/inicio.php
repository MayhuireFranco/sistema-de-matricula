<div class="table-responsive mt-5">
    <table class="table border">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Estudiante</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cursos</th>
                <th scope="col">Total créditos</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
 
        <?php foreach (($listaMatriculas ?? []) as $matricula) { ?>
                <tr>
                    <td><?php echo $matricula->getId(); ?></td>
                    <td><?php echo $matricula->getNombreEstudiante(); ?></td>
                    <td><?php echo $matricula->getFechaMatricula(); ?></td>
                    <td>
                        <?php echo implode(", ", $matricula->getCursos()); ?>
                    </td>
                    <td><?php echo $matricula->getTotalCreditos(); ?></td>
                    <td><?php echo $matricula->getEstado(); ?></td>
                    <td>
                        <a href="?controlador=matricula&accion=eliminar
                                  &id=<?php echo $matricula->getId(); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm(
                               '¿Seguro que deseas eliminar esta matrícula?');">
                           Eliminar</a>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
