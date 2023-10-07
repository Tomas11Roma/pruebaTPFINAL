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
        <title>Bienvenido al sistema</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
      </div>
      <div class="text-center">
        <h3>Modificar datos de usuario</h3>
        <form action="modificar.php" method="post">
            <label for="nombre_usuario">Nombre de usuario</label>
            <input name="nombre_usuario" class="form-control form-control-lg"
                value="<?php echo $usuario->nombre_usuario;?>"><br>
            <label for="nombre">Nombre</label>
            <input name="nombre" class="form-control form-control-lg"
                value="<?php echo $usuario->nombre;?>"><br>
            <label for="usuario">Apellido</label>
            <input name="apellido" class="form-control form-control-lg"
                value="<?php echo $usuario->apellido;?>"><br>
            <input type="submit" value="Modificar datos" class="btn btn-primary">
        </form>
      </div>
    </body>
</html>
