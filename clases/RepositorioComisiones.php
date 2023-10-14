<?php

require_once 'Usuario.php';
require_once '.env.php';
require_once 'Anuncio.php';


class RepositorioComisiones
{
    private $conexion;

    public function __construct()
    {
        $credenciales = credenciales();
        $this->conexion = new mysqli($credenciales['servidor'], $credenciales['usuario'], $credenciales['clave'], $credenciales['base_de_datos']);
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function obtenerTodas() {
        $comisiones = [];
        $sql = "SELECT * FROM comisiones";
        $resultado = $this->conexion->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            $comisiones[] = $fila;
        }
        return $comisiones;
    }

    
}
