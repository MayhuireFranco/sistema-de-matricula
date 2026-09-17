<?php
 
class Usuario {
 
    private $id;
    private $usuario;
    private $password;
    private $rol;
    private $idProfesor;
 
    public function __construct($id, $usuario, $password, $rol, $idProfesor = null)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->rol = $rol;
        $this->idProfesor = $idProfesor;
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
 
    public function getUsuario()
    {
        return $this->usuario;
    }
 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }
 
    public function getPassword()
    {
        return $this->password;
    }
 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
 
    public function getRol()
    {
        return $this->rol;
    }
 
    public function setRol($rol)
    {
        $this->rol = $rol;
        return $this;
    }
 
    public function getIdProfesor()
    {
        return $this->idProfesor;
    }
 
    public function setIdProfesor($idProfesor)
    {
        $this->idProfesor = $idProfesor;
        return $this;
    }
}