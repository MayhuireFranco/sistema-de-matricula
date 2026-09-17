<?php

class RegistroNotas
{
    private $id;
    private $idDetalleMatricula;
    private $promedioFinal;
    private $estado;

    public function __construct($idDetalleMatricula, $promedioFinal = 0, $estado = 'en curso', $id = null)
    {
        $this->id = $id;
        $this->idDetalleMatricula = $idDetalleMatricula;
        $this->promedioFinal = $promedioFinal;
        $this->estado = $estado;
    }

    public function getId() { return $this->id; }
    public function getIdDetalleMatricula() { return $this->idDetalleMatricula; }
    public function getPromedioFinal() { return $this->promedioFinal; }
    public function setPromedioFinal($promedioFinal) { $this->promedioFinal = $promedioFinal; return $this; }
    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; return $this; }
}
