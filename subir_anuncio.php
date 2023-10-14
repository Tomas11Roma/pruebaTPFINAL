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
$controlador = new ControladorSesion();
$comisiones = $controlador->obtenerComisiones();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subir_anuncio"])) {
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];
    $id_usuario = $_SESSION["usuario"]; // Asumiendo que el ID del usuario está en la sesión
    $comisiones = $_POST["comision"]; // Asumiendo que las comisiones se envían como un array

    $anuncio = new Anuncio($titulo, $texto, null, $id_usuario, [$comisiones]);
    $controlador->guardarAnuncio($anuncio);
    $_SESSION['mensaje'] = "Anuncio subido con éxito.";
    header("Location: subir_anuncio.php");
    exit();
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
        <h1>Pizarra de Anuncios - Nuevo anuncio</h1>
        <div>
            <a href="central_anuncios.php">Volver a la página anterior</a><br>
            <a href="index.php">Ir al índice de anuncios</a>
        </div>
    </div>
    <div class="text-center">
        <h3>Subir nuevo anuncio</h3>
        <?php
if (isset($_SESSION['mensaje'])) {
    echo "<p class='mensaje-exito'>" . $_SESSION['mensaje'] . "</p>";
    unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo
}
?>
        <form action="subir_anuncio.php" method="post">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required>
    <br>
    <label for="texto">Descripción:</label>
    <textarea name="texto" required></textarea>
    <br>
    <label for="comision">Comisión:</label>
    <select name="comision">
        <?php
        foreach ($comisiones as $comision) {
            echo "<option value='" . $comision["id"] . "'>" . $comision["id"] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="subir_anuncio" value="Subir Anuncio">
</form>
    </div>
</body>
</html>

<!-- <form action="subir_anuncio.php" method="post">
            <input name="titulo" class="form-control form-control-lg" placeholder="Título" required><br>
            <input name="descripcion" class="form-control form-control-lg" placeholder="Descripción" required><br>
            <input name="anio" type="number" class="form-control form-control-lg" placeholder="Año" required><br>
            <input name="comision" type="number" class="form-control form-control-lg" placeholder="Comisión" required><br>
            <input type="submit" name="subir_anuncio" value="Subir Anuncio" class="btn btn-primary">
        </form> -->