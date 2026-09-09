<?php
    require_once __DIR__ . "/../modelos/Estudiantes.php";
    require_once __DIR__ . "/../modelos/Profesores.php";
    require_once __DIR__ . "/../modelos/Cursos.php";
    require_once __DIR__ . "/../modelos/Matriculas.php";
    require_once __DIR__ . "/../conexion.php";
class ControladorPaginas {
    public function inicio() {
        require_once("./vistas/paginas/inicio.php");
    }
     public function nosotros() {
        require_once("./vistas/paginas/nosotros.php");
    }
    public function profesores() {
        require_once("./vistas/paginas/profesores.php");
    }
    public function cursos() {
        require_once("./vistas/paginas/cursos.php");
    }
    public function estudiantes() {
        require_once("./vistas/paginas/estudiantes.php");
    }
    public function matricula() {
        require_once("./vistas/paginas/matricula.php");
    }
}
