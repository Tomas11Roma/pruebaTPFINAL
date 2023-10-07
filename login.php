<?php

require_once 'clases/ControladorSesion.php';

if (empty($_POST['usuario']) || empty($_POST['clave'])) {
    //Volver a la pantalla de login con un error.
    $redirigir = 'index.php?mensaje=Error, falta un campo obligatorio';
} else {
    $cs = new ControladorSesion();
    $respuesta = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($respuesta[0] === true) {
        // Si el login fue exitoso, redirigiremos a la home:
        $redirigir = 'home.php?mensaje=' . $respuesta[1];
    } else {
        // Si el login fracasó, redirigiremos nuevamente a la pantalla de login:
        $redirigir = 'index.php?mensaje=' . $respuesta[1];
    }
}

// Efectuamos la redirección según corresponda:
header('Location: ' . $redirigir);
