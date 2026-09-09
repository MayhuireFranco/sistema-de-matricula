<?php
if (!isset($controlador) || $controlador == "") {
    $controlador = "paginas";
}
if (!isset($accion) || $accion == "") {
    $accion = "inicio";
}

include_once("./controladores/controlador_" . $controlador . ".php");

$objControlador = "Controlador" . ucfirst($controlador);
$controlador = new $objControlador();
$controlador->$accion();
