<?php
require_once 'clases/Anuncio.php';
require_once 'clases/RepositorioAnuncios.php';
require_once 'clases/ControladorSesion.php';

$controlador = new ControladorSesion();

// Verificar si se ha enviado un filtro de vigencia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vigencia"])) {
    $vigenciaSeleccionada = $_POST["vigencia"];
    if ($vigenciaSeleccionada === "all") {
        $anuncios = $controlador->obtenerAnuncios();
    } else {
        $anuncios = $controlador->obtenerAnunciosPorVigencia($vigenciaSeleccionada);
    }
} else {
    $anuncios = $controlador->obtenerAnuncios();
}

// Verificar si se ha solicitado un orden específico
if (isset($_POST["ordenar_reciente"])) {
    $anuncios = $controlador->obtenerAnuncios("reciente");
} elseif (isset($_POST["ordenar_antiguo"])) {
    $anuncios = $controlador->obtenerAnuncios("antiguo");
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
        <h1>Pizarra de Anuncios</h1>
        <p><a href="linkLogin.php">Login Personal</a></p>
    </div>
    <div class="text-center">
        <h3>Anuncios publicados</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Anuncio</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Fecha de Publicación</th>
                    <th>ID Personal</th>
                    <th>ID Comisión</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anuncios as $anuncio): ?>
                    <tr>
                        <td>
                            <?= $anuncio->id ?>
                        </td>
                        <td>
                            <?= $anuncio->titulo ?>
                        </td>
                        <td>
                            <?= $anuncio->texto ?>
                        </td>
                        <td>
                            <?= $anuncio->fecha_publicacion ?>
                        </td>
                        <td>
                            <?= $anuncio->usuarios_id ?>
                        </td>
                        <td>
                            <?php
                            // Mostrar todos los comisiones_id asociados al anuncio
                            echo implode(", ", $anuncio->getComisiones());
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div><br>
    <div class="text-center">
        <form action="index.php" method="post">
            <input type="submit" name="ordenar_reciente" value="Ordenar por fecha reciente" class="btn btn-secondary">
            <input type="submit" name="ordenar_antiguo" value="Ordenar por fecha antigua" class="btn btn-secondary">
        </form>
        <br>
        <form method="post" action="">
            <label for="vigencia">Filtrar por vigencia:</label>
            <select name="vigencia">
                <option value="all">Todos los anuncios</option>
                <option value="1">Vigente</option>
                <option value="0">No Vigente</option>
            </select>
            <input type="submit" value="Filtrar">
        </form>
    </div>
</body>

</html>