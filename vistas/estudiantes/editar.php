<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar estudiante</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-4">

    <h1>
        Editar estudiante
    </h1>


    <form
        action="?controlador=estudiantes&accion=editar"
        method="POST"
        enctype="multipart/form-data"
        onsubmit="return validarFormulario();"
    >


        <!-- ID -->

        <input
            type="hidden"
            name="id"
            value="<?php echo $estudiante->getId(); ?>"
        >


        <!-- NOMBRES -->

        <div class="mb-3">

            <label class="form-label">
                Nombres
            </label>

            <input
                type="text"
                name="nombres"
                id="nombres"
                class="form-control"
                value="<?php echo htmlspecialchars(
                    $estudiante->getNombres()
                ); ?>"
            >

        </div>


        <!-- APELLIDOS -->

        <div class="mb-3">

            <label class="form-label">
                Apellidos
            </label>

            <input
                type="text"
                name="apellidos"
                id="apellidos"
                class="form-control"
                value="<?php echo htmlspecialchars(
                    $estudiante->getApellidos()
                ); ?>"
            >

        </div>


        <!-- DIRECCION -->

        <div class="mb-3">

            <label class="form-label">
                Dirección
            </label>

            <input
                type="text"
                name="direccion"
                id="direccion"
                class="form-control"
                value="<?php echo htmlspecialchars(
                    $estudiante->getDireccion()
                ); ?>"
            >

        </div>


        <!-- TELEFONO -->

        <div class="mb-3">

            <label class="form-label">
                Teléfono
            </label>

            <input
                type="text"
                name="telefono"
                id="telefono"
                class="form-control"
                value="<?php echo htmlspecialchars(
                    $estudiante->getTelefono()
                ); ?>"
            >

        </div>


        <!-- EMAIL -->

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="<?php echo htmlspecialchars(
                    $estudiante->getEmail()
                ); ?>"
            >

        </div>


        <!-- FOTO ACTUAL -->

        <div class="mb-3">

            <label class="form-label">
                Foto actual
            </label>

            <br>

            <img
                src="imagenes/<?php echo htmlspecialchars($estudiante->getFoto()); ?>"
                width="120"
                height="120"
                style="object-fit: cover;"
                alt="Foto actual"
            >

        </div>


        <!-- NUEVA FOTO -->

        <div class="mb-3">

            <label class="form-label">
                Nueva foto
            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control"
                accept="image/*"
            >

            <div class="form-text">
                Si no selecciona una nueva foto,
                se conservará la foto actual.
            </div>

        </div>


        <button
            type="submit"
            class="btn btn-success"
        >
            Actualizar
        </button>


        <a
            href="?controlador=estudiantes&accion=inicio"
            class="btn btn-secondary"
        >
            Cancelar
        </a>

    </form>

</div>


<script>

function validarFormulario()
{
    let nombres =
        document.getElementById("nombres").value.trim();

    let apellidos =
        document.getElementById("apellidos").value.trim();

    let direccion =
        document.getElementById("direccion").value.trim();

    let telefono =
        document.getElementById("telefono").value.trim();

    let email =
        document.getElementById("email").value.trim();


    if (nombres === "")
    {
        alert("Ingrese los nombres.");
        return false;
    }


    if (apellidos === "")
    {
        alert("Ingrese los apellidos.");
        return false;
    }


    if (direccion === "")
    {
        alert("Ingrese la dirección.");
        return false;
    }


    if (telefono === "")
    {
        alert("Ingrese el teléfono.");
        return false;
    }


    if (email === "")
    {
        alert("Ingrese el email.");
        return false;
    }


    return true;
}

</script>

</body>

</html>