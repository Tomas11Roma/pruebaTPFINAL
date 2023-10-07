<?php

class Usuario
{
    protected $id;
    public $nombre_usuario;
    public $nombre;
    public $apellido;

    public function __construct($nombre_usuario, $nombre, $apellido, $id=null)
    {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getNombreApellido()
    {
        return "$this->nombre $this->apellido";
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setDatos($nombre_usuario, $nombre, $apellido)
    {
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
}

