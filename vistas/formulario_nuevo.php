<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Nuevo estudiante</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    >

</head>

<body class="p-4">

<div class="container">

    <h1>
        Registrar estudiante
    </h1>


    <form
        action="../controladores/nuevo.php"
        method="POST"
        enctype="multipart/form-data"
        onsubmit="return validarFormulario();"
    >

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
            href="../controladores/listado.php"
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
        alert("Debe ingresar los nombres.");
        return false;
    }


    if (apellidos === "")
    {
        alert("Debe ingresar los apellidos.");
        return false;
    }


    if (direccion === "")
    {
        alert("Debe ingresar la dirección.");
        return false;
    }


    if (telefono === "")
    {
        alert("Debe ingresar el teléfono.");
        return false;
    }


    if (email === "")
    {
        alert("Debe ingresar el email.");
        return false;
    }


    return true;
}

</script>

</body>
</html>