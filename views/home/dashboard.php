<?php
    require_once('../../config/Database.php');
    require_once('../../models/User.php');
    

    $usuarios = selectUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../../public/styles/style.css" rel="stylesheet">
</head>
<body class="bg-red-500">

    

    <div>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Nombre de usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Id Rol</th>

                <?php foreach ($usuarios as $usuario) { ?>

                    <tr>
                        <td><?php echo $usuario['idUser']?></td>
                        <td><?php echo $usuario['userName']?></td>
                        <td><?php echo $usuario['name']?></td>
                        <td><?php echo $usuario['surname']?></td>
                        <td><?php echo $usuario['email']?></td>
                        <td><?php echo $usuario['password']?></td>
                        <td><?php echo $usuario['idRole']?></td>
                    </tr>

                <?php } ?>
            </tr>
        </table>
    </div>

    
</body>
</html>