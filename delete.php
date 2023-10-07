<?php
require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

// Validamos que el usuario tenga sesión iniciada:
session_start();
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}

if (empty($_POST['usuario']) || $_POST['usuario'] != $usuario->nombre_usuario) {
    header("Location: home.php?mensaje=Error al eliminar el usuario");
    die();
}

$cs = new ControladorSesion();

$resultado = $cs->eliminar($usuario);

if ($resultado) {
    $redirigir = "index.php?mensaje=Usuario eliminado";
    session_destroy();
} else {
    $redirigir = "home.php?mensaje=No se pudo eliminar su usuario por un error interno";
}

header("Location: $redirigir");
