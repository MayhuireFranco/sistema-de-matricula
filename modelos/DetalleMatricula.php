<?php
 
class DetalleMatricula {
 
    private $id;
    private $idMatricula;
    private $idCurso;
    private $creditos;
 
    public function __construct($id, $idMatricula, $idCurso, $creditos)
    {
        $this->id = $id;
        $this->idMatricula = $idMatricula;
        $this->idCurso = $idCurso;
        $this->creditos = $creditos;
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
 
    public function getIdMatricula()
    {
        return $this->idMatricula;
    }
 
    public function setIdMatricula($idMatricula)
    {
        $this->idMatricula = $idMatricula;
        return $this;
    }
 
    public function getIdCurso()
    {
        return $this->idCurso;
    }
 
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;
        return $this;
    }
 
    public function getCreditos()
    {
        return $this->creditos;
    }
 
    public function setCreditos($creditos)
    {
        $this->creditos = $creditos;
        return $this;
    }
}
