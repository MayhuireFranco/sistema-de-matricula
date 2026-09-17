<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-principal { flex: 1; }
        .menu-principal .nav-link { text-align:center; padding: .75rem .8rem; }
        @media (min-width: 992px) {
            .menu-principal .navbar-nav { width:100%; }
            .menu-principal .nav-item { flex:1 1 0; }
            .menu-principal .nav-link { border-left:1px solid rgba(255,255,255,.15); }
            .menu-principal .nav-item:last-child .nav-link { border-right:1px solid rgba(255,255,255,.15); }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid px-3">
        <a class="navbar-brand fw-bold text-nowrap me-3" href="index.php?controlador=paginas&accion=inicio">SISTEMA DE MATRÍCULA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse menu-principal" id="menuPrincipal">
            <ul class="navbar-nav align-items-lg-center">
                <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=paginas&accion=inicio">Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=paginas&accion=nosotros">Nosotros</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=profesores&accion=inicio">Profesores</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['idUsuario'])): ?>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=cursos&accion=inicio">Cursos</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=estudiantes&accion=inicio">Estudiantes</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?controlador=matricula&accion=inicio">Matrícula</a></li>
                <?php endif; ?>

                <li class="nav-item">
                    <?php if (isset($_SESSION['idUsuario'])): ?>
                        <span class="nav-link text-white">
                            <?= htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8') ?>
                            (<?= htmlspecialchars($_SESSION['rol'], ENT_QUOTES, 'UTF-8') ?>)
                        </span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['idUsuario'])): ?>
                        <a class="nav-link text-white" href="index.php?controlador=login&accion=salir">Salir</a>
                    <?php else: ?>
                        <a class="nav-link text-white fw-bold" href="index.php?controlador=login&accion=mostrar">Iniciar sesión</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
