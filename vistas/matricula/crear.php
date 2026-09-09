<?php
$listaEstudiantes = $listaEstudiantes ?? [];
$listaCursos = $listaCursos ?? [];
?>

<div class="container mt-5">
    <h2>Nueva matrícula</h2>
    <form method="POST" action="?controlador=matricula&accion=crear" id="formMatricula">
        <div class="mb-3">
            <label>Estudiante</label>
            <select name="id_estudiante" class="form-control">
                <option value="">Selecciona un estudiante</option>
                <?php foreach ($listaEstudiantes as $estudiante) { ?>
                <option value="<?php echo $estudiante->getId(); ?>">
                    <?php echo $estudiante->getNombres() . " " . $estudiante->getApellidos(); ?>
                </option>
                <?php } ?>
            </select>
        </div>
 
        <div class="mb-3">
            <label>Cursos</label>
            <?php foreach ($listaCursos as $curso) { ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="cursos[]"
                       value="<?php echo $curso->getId(); ?>"
                       id="curso<?php echo $curso->getId(); ?>">
                <label class="form-check-label"
                       for="curso<?php echo $curso->getId(); ?>">
                    <?php echo $curso->getNombreCurso(); ?>
                    (<?php echo $curso->getCreditos(); ?> créditos)
                </label>
            </div>
            <?php } ?>
        </div>
 
        <button type="submit" class="btn btn-primary">Matricular</button>
    </form>
</div>
 
<script>
document.getElementById("formMatricula").addEventListener("submit", function (e) {
    const idEstudiante = document.querySelector("[name=id_estudiante]").value;
    const cursosMarcados = document.querySelectorAll(
        "[name='cursos[]']:checked"
    );
 
    if (idEstudiante === "" || cursosMarcados.length === 0) {
        e.preventDefault();
        alert("Selecciona un estudiante y al menos un curso.");
    }
});
</script>
