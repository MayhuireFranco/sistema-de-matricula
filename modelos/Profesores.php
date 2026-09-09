<?php

class Profesores {

    private $id;
    private $nombres;
    private $apellidos;
    private $especialidad;

    public function __construct($id, $nombres, $apellidos, $especialidad)
    {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->especialidad = $especialidad;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
        return $this;
    }
}