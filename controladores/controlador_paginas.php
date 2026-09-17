<?php

require_once __DIR__ . "/../modelos/Estudiantes.php";
require_once __DIR__ . "/../modelos/Profesores.php";
require_once __DIR__ . "/../modelos/Cursos.php";
require_once __DIR__ . "/../modelos/Matricula.php";
require_once __DIR__ . "/../modelos/BD.php";

class ControladorPaginas {

    public function inicio() {
        require_once __DIR__ . "/../vistas/paginas/inicio.php";
    }

    public function nosotros() {
        require_once __DIR__ . "/../vistas/paginas/nosotros.php";
    }

    public function profesores() {
        require_once __DIR__ . "/../vistas/paginas/profesores.php";
    }

    public function cursos() {
        require_once __DIR__ . "/../vistas/paginas/cursos.php";
    }

    public function estudiantes() {
        require_once __DIR__ . "/../vistas/paginas/estudiantes.php";
    }

    public function matricula() {
        require_once __DIR__ . "/../vistas/matricula/inicio.php";
    }
}
?>
