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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Pizarra de Anuncios</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Pizarra de Anuncios - Eliminar anuncio</h1>
      <div>
      <a href="central_anuncios.php">Volver a la página anterior</a><br>
<a href="index.php">Ir al índice de anuncios</a>
      </div>
      </div>
      <div class="text-center">
        <h3>Eliminar anuncio</h3>
        <form action="eliminar.php" method="post">
            <label for="titulo">Título</label>
            <input name="titulo" class="form-control form-control-lg"><br>
            <input type="submit" value="Eliminar anuncio" class="btn btn-primary">
        </form>
      </div>
    </body>
</html>