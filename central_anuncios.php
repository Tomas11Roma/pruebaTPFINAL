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
      <h1>Pizarra de Anuncios - Central de Anuncios</h1>
      </div>
      <div class="text-center">
        <h3>Elige la siguiente acción:</h3>
        <form action="subir_anuncio.php" method="post">
        <input type="submit" value="Subir anuncio" class="btn btn-primary">
        </form><br>

        <form action="eliminar_anuncio.php" method="post">
        <input type="submit" value="Eliminar anuncio" class="btn btn-primary">
        </form><br>

        <form action="modificar_anuncio.php" method="post">
        <input type="submit" value="Modificar anuncio" class="btn btn-primary">
        </form><br>

        <form action="index.php" method="post">
        <input type="submit" value="Mostrar anuncios" class="btn btn-primary">
        </form><br>
      </div>
    </body>
</html>


<!-- <label for="titulo">Subir anuncio</label>
            <input name="titulo" class="form-control form-control-lg"><br>
            <label for="titulo">Eliminar anuncio</label>
            <input name="descripcion" class="form-control form-control-lg"><br>
            <label for="titulo">Modificar anuncio</label>
            <input name="descripcion" class="form-control form-control-lg"><br>
            <label for="fecha">Mostrar anuncios</label>
            <input name="descripcion" class="form-control form-control-lg"><br><br> -->