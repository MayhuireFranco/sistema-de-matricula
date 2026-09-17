<?php

// OBTENER CONTROLADOR Y ACCIÓN DESDE LA URL
$controlador = $_GET['controlador'] ?? 'paginas';
$accion = $_GET['accion'] ?? 'inicio';



$rutasPublicas = [
    'login' => ['mostrar', 'verificar']
];

$esRutaPublica = isset($rutasPublicas[$controlador]) &&
                 in_array($accion, $rutasPublicas[$controlador], true);




if (!$esRutaPublica && !isset($_SESSION['idUsuario'])) {

    header('Location: index.php?controlador=login&accion=mostrar');
    exit();
}



if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente') {

    $rutasPermitidasDocente = [
        'paginas' => [
            'inicio',
            'nosotros'
        ],

        'cursos' => [
            'inicio',
            'verAlumnos'
        ],

        'notas' => [
            'calificar',
            'guardar'
        ],

        'login' => [
            'salir'
        ]
    ];

    $accionPermitida =
        isset($rutasPermitidasDocente[$controlador]) &&
        in_array(
            $accion,
            $rutasPermitidasDocente[$controlador],
            true
        );

    if (!$accionPermitida) {

        header(
            'Location: index.php?controlador=cursos&accion=inicio'
        );

        exit();
    }
}




$mapaControladores = [

    'login' => 'controlador_login.php',

    'paginas' => 'controlador_paginas.php',

    'estudiantes' => 'controlador_Estudiantes.php',

    'profesores' => 'controlador_profesores.php',

    'cursos' => 'controlador_cursos.php',

    'matricula' => 'controlador_matricula.php',

    'notas' => 'controlador_notas.php'
];




if (!isset($mapaControladores[$controlador])) {

    $controlador = 'paginas';
    $accion = 'inicio';
}




require_once __DIR__ .
    '/controladores/' .
    $mapaControladores[$controlador];




$nombreClase = 'Controlador' . ucfirst($controlador);



if (!class_exists($nombreClase)) {

    exit(
        "No se encontró la clase: " .
        htmlspecialchars(
            $nombreClase,
            ENT_QUOTES,
            'UTF-8'
        )
    );
}



$objeto = new $nombreClase();




if (!method_exists($objeto, $accion)) {

    exit(
        "La acción '" .
        htmlspecialchars(
            $accion,
            ENT_QUOTES,
            'UTF-8'
        ) .
        "' no existe en " .
        htmlspecialchars(
            $nombreClase,
            ENT_QUOTES,
            'UTF-8'
        )
    );
}



$objeto->$accion();