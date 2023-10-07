<?php

require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

// Validamos lo que llegó por POST.
if (
    empty($_POST['nombre_usuario'])
    || empty($_POST['nombre'])
    || empty($_POST['apellido'])
) {
    $mensaje = "No fue posible realizar la actualización, faltan campos.";
    header("Location:home.php?mensaje=$mensaje");
    die();
}

$cs = new ControladorSesion();

$resultado = $cs->modificar($_POST['nombre_usuario'], $_POST['nombre'], $_POST['apellido'], $usuario);

if ($resultado) {
    $redirigir = "home.php?mensaje=Datos actualizados correctamente";
} else {
    $redirigir = "home.php?mensaje=Error al actualizar datos";
}
header("Location: $redirigir");



