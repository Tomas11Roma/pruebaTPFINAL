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
</div>
</div>
        <p><a href="linkLogin.php">Login del personal</a></p>
    </div>
</body>

</html>
