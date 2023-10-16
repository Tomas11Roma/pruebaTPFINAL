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

// Obtiene todos los anuncios para mostrarlos en un dropdown
$anuncios = $controlador->obtenerAnuncios();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_anuncio"])) {
    $id_anuncio = $_POST["id_anuncio"];
    $controlador->eliminarAnuncioPorId($id_anuncio);
    $_SESSION['mensaje'] = "Anuncio eliminado con éxito.";
    header("Location: eliminar_anuncio.php");
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
        <h1>Pizarra de Anuncios - Eliminar anuncio</h1>
        <div>
            <a href="central_anuncios.php">Volver a la página anterior</a><br>
            <a href="index.php">Ir al índice de anuncios</a>
        </div>
    </div>
    <div class="text-center">
        <h3>Eliminar anuncio</h3>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<p class='mensaje-exito'>" . $_SESSION['mensaje'] . "</p>";
            unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo
        }
        ?>
        <form action="eliminar_anuncio.php" method="post">
            <label for="id_anuncio">Selecciona el ID del anuncio a eliminar:</label>
            <select name="id_anuncio">
                <?php foreach ($anuncios as $anuncio) { ?>
                    <option value="<?php echo $anuncio->getId(); ?>">
                        <?php echo $anuncio->getId(); ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" name="eliminar_anuncio" value="Eliminar Anuncio">
        </form>

    </div>
</body>

</html>