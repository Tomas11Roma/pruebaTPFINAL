<?php
require_once 'Anuncio.php';
require_once 'clases/RepositorioAnuncios.php';
require_once 'clases/ControladorSesion.php';

$controlador = new ControladorSesion();
$anuncios = $controlador->obtenerAnuncios();

$anuncios = [];
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

$orden = "";
if (isset($_POST["ordenar_reciente"])) {
    $orden = "reciente";
} elseif (isset($_POST["ordenar_antiguo"])) {
    $orden = "antiguo";
}
$anuncios = $controlador->obtenerAnuncios($orden);
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
                <th>ID</th>
                <th>Titulo</th>
                <th>Descripción</th>
                <th>Fecha de Publicación</th>
                <th>ID Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anuncios as $anuncio): ?>
                <tr>
                    <td><?= $anuncio->id ?></td>
                    <td><?= $anuncio->titulo ?></td>
                    <td><?= $anuncio->texto ?></td>
                    <td><?= $anuncio->fecha_publicacion ?></td>
                    <td><?= $anuncio->usuarios_id ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
<div class="text-center">
    <h3>Filtros:</h3>
    <form action="index.php" method="post">
        <input type="submit" name="ordenar_reciente" value="Ordenar por fecha reciente" class="btn btn-secondary">
        <input type="submit" name="ordenar_antiguo" value="Ordenar por fecha antigua" class="btn btn-secondary">
    </form>
    <br>
</div>

</body>

</html>
