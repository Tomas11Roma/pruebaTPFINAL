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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Año</th>
                    <th>Comision</th>
                    <th>Vigencia</th>
                    <th>Id Usuario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div><br>
    <div>
        <p><a href="linkLogin.php">Login del personal</a></p>
    </div>
</body>

</html>
<!-- 
<tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['name'] ?></th>
                        <th><?= $row['lastname'] ?></th>
                        <th><?= $row['username'] ?></th>
                        <th><?= $row['password'] ?></th>
                        <th><?= $row['email'] ?></th>
                        <th><a href="update.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></th>
                        <th><a href="delete_user.php?id=<?= $row['id'] ?>" class="users-table--delete" >Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
            </tbody> -->