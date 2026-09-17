<?php

require_once __DIR__ . "/../modelos/Profesores.php";
require_once __DIR__ . "/../modelos/BD.php";
 
class ControladorProfesores {
 
    public function inicio()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("SELECT * FROM profesores ORDER BY apellidos");
        $consulta->execute();
 
        $listaProfesores = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $listaProfesores[] = new Profesores($fila["id"], $fila["nombres"], $fila["apellidos"], $fila["especialidad"]);
        }
 
        require_once __DIR__ . "/../vistas/profesores/inicio.php";
    }
 
    public function crear()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexion = BD::crearInstancia();
            $consulta = $conexion->prepare("INSERT INTO profesores (nombres, apellidos, especialidad) VALUES (?, ?, ?)");
            $consulta->execute([$_POST["nombres"], $_POST["apellidos"], $_POST["especialidad"]]);
 
            header("Location: ./?controlador=profesores&accion=inicio");
        } else {
            require_once __DIR__ . "/../vistas/profesores/crear.php";
        }
    }
 
    public function editar()
    {
        $conexion = BD::crearInstancia();
 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $consulta = $conexion->prepare("UPDATE profesores SET nombres=?, apellidos=?, especialidad=? WHERE id=?");
            $consulta->execute([$_POST["nombres"], $_POST["apellidos"], $_POST["especialidad"], $_POST["id"]]);
 
            header("Location: ./?controlador=profesores&accion=inicio");
        } else {
            $consulta = $conexion->prepare("SELECT * FROM profesores WHERE id=?");
            $consulta->execute([$_GET["id"]]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);
            $profesor = new Profesores($fila["id"], $fila["nombres"], $fila["apellidos"], $fila["especialidad"]);
 
            require_once __DIR__ . "/../vistas/profesores/editar.php";
        }
    }
 
    public function eliminar()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("DELETE FROM profesores WHERE id=?");
        $consulta->execute([$_GET["id"]]);
 
        header("Location: ./?controlador=profesores&accion=inicio");
    }
}