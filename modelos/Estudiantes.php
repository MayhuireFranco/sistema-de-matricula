<?php

require_once __DIR__ . "/BD.php";

class Estudiante
{
    private $id;
    private $nombres;
    private $apellidos;
    private $direccion;
    private $telefono;
    private $email;
    private $foto;

    public function __construct(
        $id = null,
        $nombres = "",
        $apellidos = "",
        $direccion = "",
        $telefono = "",
        $email = "",
        $foto = ""
    ) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->foto = $foto;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFoto()
    {
        return $this->foto;
    }


    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }


    // CONSULTAR TODOS

    public function consultarTodos()
    {
        $conexion = BD::crearInstancia();

        $sql = "SELECT * FROM estudiantes ORDER BY id DESC";

        $consulta = $conexion->prepare($sql);
        $consulta->execute();

        $estudiantes = [];

        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

            $estudiantes[] = new Estudiante(
                $fila['id'],
                $fila['nombres'],
                $fila['apellidos'],
                $fila['direccion'],
                $fila['telefono'],
                $fila['email'],
                $fila['foto']
            );
        }

        return $estudiantes;
    }


    // INSERTAR

    public function insertar()
    {
        $conexion = BD::crearInstancia();

        $sql = "INSERT INTO estudiantes
                (nombres, apellidos, direccion, telefono, email, foto)
                VALUES
                (:nombres, :apellidos, :direccion, :telefono, :email, :foto)";

        $consulta = $conexion->prepare($sql);

        $consulta->bindParam(':nombres', $this->nombres);
        $consulta->bindParam(':apellidos', $this->apellidos);
        $consulta->bindParam(':direccion', $this->direccion);
        $consulta->bindParam(':telefono', $this->telefono);
        $consulta->bindParam(':email', $this->email);
        $consulta->bindParam(':foto', $this->foto);

        return $consulta->execute();
    }


    // ACTUALIZAR

    public function actualizar($cambiarFoto = false)
    {
        $conexion = BD::crearInstancia();

        if ($cambiarFoto) {

            $sql = "UPDATE estudiantes SET
                    nombres = :nombres,
                    apellidos = :apellidos,
                    direccion = :direccion,
                    telefono = :telefono,
                    email = :email,
                    foto = :foto
                    WHERE id = :id";

        } else {

            $sql = "UPDATE estudiantes SET
                    nombres = :nombres,
                    apellidos = :apellidos,
                    direccion = :direccion,
                    telefono = :telefono,
                    email = :email
                    WHERE id = :id";
        }

        $consulta = $conexion->prepare($sql);

        $consulta->bindParam(':id', $this->id);
        $consulta->bindParam(':nombres', $this->nombres);
        $consulta->bindParam(':apellidos', $this->apellidos);
        $consulta->bindParam(':direccion', $this->direccion);
        $consulta->bindParam(':telefono', $this->telefono);
        $consulta->bindParam(':email', $this->email);

        if ($cambiarFoto) {
            $consulta->bindParam(':foto', $this->foto);
        }

        return $consulta->execute();
    }


    // ELIMINAR

    public function eliminar()
    {
        $conexion = BD::crearInstancia();

        $sql = "DELETE FROM estudiantes WHERE id = :id";

        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':id', $this->id);

        return $consulta->execute();
    }
}