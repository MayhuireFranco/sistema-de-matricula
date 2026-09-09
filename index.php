<?php
 
if (isset($_GET["controlador"]) && isset($_GET["accion"])
    && $_GET["controlador"] != "" && $_GET["accion"] != "") {
    $controlador = $_GET["controlador"];
    $accion = $_GET["accion"];
} 
 
include_once("./vistas/template.php");
