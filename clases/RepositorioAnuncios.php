<?php

require_once 'Usuario.php';
require_once '.env.php';
require_once 'Anuncio.php';

class RepositorioAnuncios
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
    public function leer()
    {
        $anuncios = [];
        $sql = "SELECT a.id, a.titulo, a.texto, a.fecha_publicacion, a.usuarios_id, ac.comisiones_id 
            FROM anuncios a 
            JOIN `anuncios.comisiones` ac ON a.id=ac.anuncios_id 
            JOIN comisiones c ON ac.comisiones_id = c.id 
            ORDER BY a.fecha_publicacion DESC";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], [$row['comisiones_id']], $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }


    public function leerOrdenadoPorFechaAntigua()
    {
        $anuncios = [];
        $sql = "SELECT a.id, a.titulo, a.texto, a.fecha_publicacion, a.usuarios_id, GROUP_CONCAT(ac.comisiones_id) as comisiones_ids 
            FROM anuncios a 
            LEFT JOIN `anuncios.comisiones` ac ON a.id = ac.anuncios_id 
            GROUP BY a.id 
            ORDER BY a.fecha_publicacion ASC";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comisiones_ids = explode(',', $row['comisiones_ids']);
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], $comisiones_ids, $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }

    public function leerPorVigencia($vigente)
    {
        $anuncios = [];
        $sql = "SELECT a.id, a.titulo, a.texto, a.fecha_publicacion, a.usuarios_id, GROUP_CONCAT(ac.comisiones_id) as comisiones_ids 
            FROM anuncios a 
            LEFT JOIN `anuncios.comisiones` ac ON a.id = ac.anuncios_id 
            WHERE a.vigente = ? 
            GROUP BY a.id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $vigente);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comisiones_ids = explode(',', $row['comisiones_ids']);
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], $comisiones_ids, $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }

    public function actualizarVigencia($id_anuncio, $vigencia)
    {
        $sql = "UPDATE anuncios SET vigente = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $vigencia, $id_anuncio);
        $stmt->execute();
        $stmt->close();
    }

    public function guardar(Anuncio $anuncio)
    {
        // Paso 1: Insertar el anuncio en la tabla `anuncios`
        $sql = "INSERT INTO anuncios (titulo, texto, fecha_publicacion, vigente, usuarios_id) VALUES (?, ?, NOW(), 1, ?)";
        $query = $this->conexion->prepare($sql);
        $titulo = $anuncio->getTitulo();
        $texto = $anuncio->getTexto();
        $usuario_id = $anuncio->getUsuariosId();
        $query->bind_param("ssi", $titulo, $texto, $usuario_id);

        if ($query->execute()) {
            // Paso 2: Obtener el ID del anuncio insertado
            $anuncio_id = $this->conexion->insert_id;
            $query->close();

            // Paso 3: Insertar la relación en la tabla intermedia
            $comisiones = $anuncio->getComisiones();
            foreach ($comisiones as $comision_id) {
                $sql = "INSERT INTO `anuncios.comisiones` (anuncios_id, comisiones_id) VALUES (?, ?)";
                $query = $this->conexion->prepare($sql);
                $query->bind_param("is", $anuncio_id, $comision_id);
                if (!$query->execute()) {
                    $query->close();
                    return false;
                }
                $query->close();
            }
            return true;
        } else {
            return false;
        }
    }

    public function eliminarPorId($id_anuncio)
    {
        $sql = "DELETE FROM anuncios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_anuncio);
        $stmt->execute();
        $stmt->close();
    }
}