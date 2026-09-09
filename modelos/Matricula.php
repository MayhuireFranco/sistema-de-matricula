<?php
 
class Matricula {
 
    private $id;
    private $idEstudiante;
    private $fechaMatricula;
    private $totalCreditos;
    private $estado;
    private $nombreEstudiante; // solo para el listado, viene del JOIN
    private $cursos;           // solo para el listado, nombres de los cursos
 
    public function __construct(
        $id, $idEstudiante, $fechaMatricula, $totalCreditos, $estado,
        $nombreEstudiante = null, $cursos = []
    ) {
        $this->id = $id;
        $this->idEstudiante = $idEstudiante;
        $this->fechaMatricula = $fechaMatricula;
        $this->totalCreditos = $totalCreditos;
        $this->estado = $estado;
        $this->nombreEstudiante = $nombreEstudiante;
        $this->cursos = $cursos;
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
 
    public function getIdEstudiante()
    {
        return $this->idEstudiante;
    }
 
    public function setIdEstudiante($idEstudiante)
    {
        $this->idEstudiante = $idEstudiante;
        return $this;
    }
 
    public function getFechaMatricula()
    {
        return $this->fechaMatricula;
    }
 
    public function setFechaMatricula($fechaMatricula)
    {
        $this->fechaMatricula = $fechaMatricula;
        return $this;
    }
 
    public function getTotalCreditos()
    {
        return $this->totalCreditos;
    }
 
    public function setTotalCreditos($totalCreditos)
    {
        $this->totalCreditos = $totalCreditos;
        return $this;
    }
 
    public function getEstado()
    {
        return $this->estado;
    }
 
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
 
    public function getNombreEstudiante()
    {
        return $this->nombreEstudiante;
    }
 
    public function setNombreEstudiante($nombreEstudiante)
    {
        $this->nombreEstudiante = $nombreEstudiante;
        return $this;
    }
 
    public function getCursos()
    {
        return $this->cursos;
    }
 
    public function setCursos($cursos)
    {
        $this->cursos = $cursos;
        return $this;
    }
}
