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

// Obtener todos los anuncios para mostrarlos en un dropdown
$anuncios = $controlador->obtenerAnuncios();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar_vigencia"])) {
    $id_anuncio = $_POST["id_anuncio"];
    $vigencia = $_POST["vigencia"];
    $controlador->actualizarVigenciaAnuncio($id_anuncio, $vigencia);
    // Redirigir o mostrar un mensaje de éxito
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
        <h1>Pizarra de Anuncios - Modificar anuncio</h1>
        <div>
            <a href="central_anuncios.php">Volver a la página anterior</a><br>
            <a href="index.php">Ir al índice de anuncios</a>
        </div>
    </div>
    <div class="text-center">
        <h3>Modificar anuncio</h3>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<p class='alert alert-primary text-center'>" . $_SESSION['mensaje'] . "</p>";
            unset($_SESSION['mensaje']);
        }
        ?>
        <form action="modificar_anuncio.php" method="post">
            <label for="id_anuncio">Selecciona el ID del anuncio:</label>
            <select name="id_anuncio">
                <?php foreach ($anuncios as $anuncio) { ?>
                    <option value="<?php echo $anuncio->getId(); ?>">
                        <?php echo $anuncio->getId(); ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="vigencia">Vigencia:</label>
            <select name="vigencia">
                <option value="1">Vigente</option>
                <option value="0">No vigente</option>
            </select>
            <br>
            <input type="submit" name="actualizar_vigencia" value="Actualizar Vigencia">
        </form>
    </div>
</body>

</html>