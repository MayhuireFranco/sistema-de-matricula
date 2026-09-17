<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Crear estudiante</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-4">

    <h1>
        Registrar estudiante
    </h1>


    <form
        action="?controlador=estudiantes&accion=crear" 
        method="POST" 
        enctype="multipart/form-data" onsubmit="return validarFormulario();">


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
            >

        </div>


        <!-- FOTO -->

        <div class="mb-3">

            <label class="form-label">
                Foto
            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control"
                accept="image/*"
            >

        </div>


        <button
            type="submit"
            class="btn btn-success"
        >
            Guardar
        </button>


        <a
            href="../../index.php?controlador=estudiantes&accion=inicio"
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