<?php
require_once 'clases/ControladorSesion.php';

if (isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['anio']) && isset($_POST['comision'])) {
    $cs = new ControladorSesion();
    $result = $cs->guardarAnuncio($anuncio);
    if( $result[0] === true ) {
        $redirigir = 'subir_anuncio.php?mensaje='.$result[1];
    } else {
        $redirigir = 'subir_anuncio.php?mensaje='.$result[1];
    }
} else {
    $redirigir = 'subir_anuncio.php?mensaje=Completa los campos vacios';
}
header('Location: ' . $redirigir);


// if (isset($_POST['usuario']) && isset($_POST['clave'])) {
//     $cs = new ControladorSesion();
//     $result = $cs->guardarAnuncio($_POST['titulo'], $_POST['descripcion'],
//                           $_POST['anio'], $_POST['comision']);
//     if( $result[0] === true ) {
//         $redirigir = 'subir_anuncio.php?mensaje='.$result[1];
//     } else {
//         $redirigir = 'subir_anuncio.php?mensaje='.$result[1];
//     }
// } else {
//     $redirigir = 'subir_anuncio.php?mensaje=Completa los campos vacios';
// }
// header('Location: ' . $redirigir);
