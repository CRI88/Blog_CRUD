<?php

    require_once('../../config/Database.php');
    require_once('../../models/UserModel.php');

    $id = $_GET['id'];

    //Consulta a la base de datos
    $userModifying = selectUserId($id);

    var_dump($userModifying);


    echo $userModifying["userName"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify user</title>
    <script src="../../scripts/scriptCheckPassword.js" defer></script>
</head>
<body>

<?php require_once('../../config/mensajes.php') ?>

<div class="flex flex-col items-center justify-center">

    <form action="../../controllers/UserController.php" method="POST">

        <label>Id de usuario:</label>
        <input type="hidden" name="newIdUser" value="<?php echo $userModifying['idUser']; ?>">
        <input type="text" id="editTextIdUsuario" name="newIdUser" value="<?php echo $userModifying['idUser']; ?>" disabled>

        <label>Nombre de usuario:</label>
        <input type="text" id="editTextNombreUsuario" value="<?php echo $userModifying['userName']; ?>" disabled>

        <label>Nueva contraseña:</label>
        <input type="password" id="editTextPassword1" name="newPassword" required>

        <label>Repite la contraseña:</label>
        <input type="password" id="editTextPassword2" name="newPassword2" required>
        <label id="textViewErrorContrasenya"></label>

        <button type="submit" name="updateUserPassword">Guardar cambios</button>

    </form>

</div>
    
</body>
</html>