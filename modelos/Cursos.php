<?php

class Curso {
    private $id;
    private $nombre_curso;
    private $creditos;
    private $id_profesor;


    public function __construct($id, $nombre_curso, $creditos, $id_profesor)
    {
        $this->id = $id;
        $this->nombre_curso = $nombre_curso;
        $this->creditos = $creditos;
        $this->id_profesor = $id_profesor;

    }

    public function getId() {
        return $this->id;
    }
    public function getNombreCurso() {
        return $this->nombre_curso;
    }
    public function getCreditos() {
        return $this->creditos;
    }
    public function getIdProfesor() {
        return $this->id_profesor;
    }
}