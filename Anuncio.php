<?php 

class Anuncio
{
    public $id;
    public $titulo;
    public $texto;
    public $fecha_publicacion;
    public $vigente = true;
    public $usuarios_id;
    public $comision_id;
    public $comisiones; // Añadido para almacenar las comisiones

    public function __construct(
        $titulo, $texto, $fecha_publicacion, $usuarios_id, Array $comisiones, $id = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->usuarios_id = $usuarios_id;
        $this->comisiones = $comisiones; // Añadido para inicializar las comisiones
    }

    public function setVigencia($vigencia)
    {
        $this->vigente = $vigencia;        
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
      // Métodos getter añadidos
      public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }

    public function getVigente() {
        return $this->vigente;
    }

    public function getUsuariosId() {
        return $this->usuarios_id;
    }

    public function getComisiones() {
        return $this->comisiones;
    }

    public function getComisionId() {
        return $this->comision_id;
    }
}
