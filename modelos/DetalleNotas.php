<?php

class DetalleNotas
{
    private $id;
    private $idRegistroNotas;
    private $tipoEvaluacion;
    private $nota;
    private $peso;
    private $fechaEvaluacion;

    public function __construct($idRegistroNotas, $tipoEvaluacion, $nota, $peso, $fechaEvaluacion, $id = null)
    {
        $this->id = $id;
        $this->idRegistroNotas = $idRegistroNotas;
        $this->tipoEvaluacion = $tipoEvaluacion;
        $this->nota = $nota;
        $this->peso = $peso;
        $this->fechaEvaluacion = $fechaEvaluacion;
    }

    public function getId() { return $this->id; }
    public function getIdRegistroNotas() { return $this->idRegistroNotas; }
    public function getTipoEvaluacion() { return $this->tipoEvaluacion; }
    public function getNota() { return $this->nota; }
    public function getPeso() { return $this->peso; }
    public function getFechaEvaluacion() { return $this->fechaEvaluacion; }
}
