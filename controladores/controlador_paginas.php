<?php
 
class ControladorPaginas {
    public function inicio() {
        require_once("./vistas/paginas/inicio.php");
    }
     public function nosotros() {
        require_once("./vistas/paginas/nosotros.php");
    }
    public function profesores() {
        require_once("./vistas/paginas/profesores");
    }
}
