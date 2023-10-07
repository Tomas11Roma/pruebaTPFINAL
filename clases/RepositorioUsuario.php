<?php

require_once 'Usuario.php';
require_once '.env.php';

class RepositorioUsuario
{
    private static $conexion = null;

    /***
     * Método constructor. Si ya había una conexión a la base de datos
     * establecida, no hace nada. Si la conexión aún no se estableció, realiza
     * la misma con mysqli, utilizando la función credenciales() del archivo
     * .env.php.
     */
    public function __construct()
    {
        $credenciales = credenciales();
        if (is_null(self::$conexion)) {
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos'],
            );
        }
        if (self::$conexion->connect_error) {
            $error = 'Error de conexion: ' . self::$conexion->connect_error;
            self::$conexion = null;
            die($error);
        }
        self::$conexion->set_charset('utf8mb4');
    }

    /**
     * Verifica el login de usuario, y retorna una instancia de la clase Usuario
     * si tiene éxito.
     *
     * @param string $nombre_usuario El nombre de usuario ingresado en el login
     * @param string $clave          La contraseña ingresada en el login
     *
     * @return mixed Si el login fracasa, retorna el valor booleano false.
     *               Si tiene éxito, retorna una instancia de la clase Usuario
     *               con los datos del usuario autenticado.
     */
    public function login($nombre_usuario, $clave)
    {
        $q = "SELECT id, clave, nombre, apellido FROM usuarios WHERE nombre_usuario = ?;";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);

        if ($query->execute()) {
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
            if ($query->fetch()) {
                // Validar que la clave esté bien:
                if (password_verify($clave, $clave_encriptada)) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $id);
                }
            }

        }
        return false;
    }

    /**
     * Crea un nuevo usuario en la BD. Retorna el id asignado por la base de
     * datos, o el valor booleano false si hubo algún error.
     *
     * @param Usuario $usuario El objeto de la clase Usuario a guardar.
     * @param string  $clave   La contraseña elegida por el nuevo usuario.
     *
     * @return mixed El valor booleano false si hubo error, o el id de usuario
     *               asignado automáticamente por la BD (valor entero).
     */
    public function save(Usuario $usuario, $clave)
    {
        $q = "INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido) ";
        $q.= "VALUES (?, ? , ? , ?)";
        $query = self::$conexion->prepare($q);

        $nombre_usuario = $usuario->nombre_usuario;
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;

        $query->bind_param("ssss", $nombre_usuario, $clave, $nombre, $apellido);

        if ($query->execute())  {
            return self::$conexion->insert_id;
        } else {
            return false;
        }
    }

    /**
     * Elimina el usuario de la BD. Retorna true si tuvo éxito, false si no.
     *
     * @params Usuario $usuario El objeto usuario a eliminar de la BD.
     *
     * @return boolean true si tuvo éxito, false de lo contrario
     */
    public function eliminar(Usuario $usuario)
    {
        $q = "DELETE FROM usuarios WHERE id = ?";
        $query = self::$conexion->prepare($q);

        $id = $usuario->getId();

        $query->bind_param("d", $id);

        return $query->execute();

        // O bien:
        // if ($query->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Actualiza en la BD los datos del usuario, y si tiene éxito, retorna true.
     *
     * @param string $nombre_usuario El nuevo nombre de usuario
     * @param string $nombre         El nuevo nombre de la persona
     * @param string $apellido       El nuevo apellido de la persona
     * @param Usuario $usuario       El objeto usuario almacenado en la sesión.
     *
     * @return boolean true si tuvo éxito, false de lo contrario.
     */
    public function actualizar(
        string $nombre_usuario,
        string $nombre,
        string $apellido,
        Usuario $usuario
    ) {
        $q = "UPDATE usuarios SET nombre_usuario = ?, nombre = ?, apellido = ? ";
        $q.= " WHERE id = ?;";

        $query = self::$conexion->prepare($q);

        $id = $usuario->getId();

        $query->bind_param("sssd", $nombre_usuario, $nombre, $apellido, $id);

        return $query->execute();
    }

}
