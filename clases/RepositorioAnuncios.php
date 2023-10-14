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
        $sql = "SELECT id, titulo, texto, fecha_publicacion, usuarios_id FROM anuncios ORDER BY fecha_publicacion DESC";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], [], $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }
    
    public function leerOrdenadoPorFechaAntigua() {
        $anuncios = [];
        $sql = "SELECT id, titulo, texto, fecha_publicacion, usuarios_id FROM anuncios ORDER BY fecha_publicacion ASC";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], [], $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }
    
    public function leerPorVigencia($vigente)
    {
        $anuncios = [];
        $sql = "SELECT id, titulo, texto, fecha_publicacion, usuarios_id FROM anuncios WHERE vigente = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $vigente);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $anuncio = new Anuncio($row['titulo'], $row['texto'], $row['fecha_publicacion'], $row['usuarios_id'], [], $row['id']);
                $anuncios[] = $anuncio;
            }
        }
        return $anuncios;
    }

    public function actualizarVigencia($id_anuncio, $vigencia) {
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
        $comisiones = $anuncio->getComisionId();
        foreach ($comisiones as $comision_id) {
            $sql = "INSERT INTO `anuncios.comisiones` (anuncios_id, comisiones_id) VALUES (?, ?)";
            $query = $this->conexion->prepare($sql);
            $query->bind_param("ii", $anuncio_id, $comision_id);
            if (!$query->execute()) {
                // Manejar error al insertar en la tabla intermedia
                $query->close();
                return false;
            }
            $query->close();
        }
        return true;
    } else {
        // Manejar error al insertar el anuncio
        return false;
    }
}


    
    
    public function eliminarPorId($id_anuncio) {
        $sql = "DELETE FROM anuncios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_anuncio);
        $stmt->execute();
        $stmt->close();
    }
}

// SELECT id, titulo, texto, fecha_publicacion, usuarios_id
// FROM anuncios
// WHERE vigente = 1;

// SELECT a.id, a.titulo, a.texto, a.fecha_publicacion, a.usuarios_id
// FROM anuncios a
// JOIN anuncios_comisiones ac ON a.id = ac.comisiones_id
// WHERE a.vigente = 1 AND ac.comisiones_id = ?;

  // UPDATE anuncios SET vigente = ? WHERE id = ?;   -- vigente puede ser 0 o 1.
      
    // DELETE FROM anuncios WHERE id = ?

    // public function guardar(Anuncio $anuncio)
    // {
    //     $sql = "INSERT INTO anuncios (titulo, texto, fecha_publicacion, vigente, usuarios_id) ";
    //     $sql .= " VALUES (?, ?, NOW(), 1, ?)";
    //     $query = self::$conexion->prepare($sql);
    //     $titulo = $anuncio->titulo;
    //     $texto = $anuncio->texto;
    //     $id_usuario = $anuncio->id_usuario;
    //     $query->bind_param("ssi", $titulo, $texto, $id_usuario);
    //     if ($query->execute()) {
    //         $id = self::$conexion->insert_id;
    //         $anuncio->setId($id);
    //         $query->close();
    //         foreach ($anuncio->comisiones as $unaComision) {
    //             $sql = "INSERT INTO anuncios_comisiones (anuncios_id, comisiones_id) ";
    //             $sql .= "VALUES (?, ?)";
    //             $query = self::$conexion->prepare($sql);
    //             $query->bind_param("ii", $id, $unaComision);
    //             $query->execute();
    //             $query->close();
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }