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
</head>
<body>

<?php require_once('../../config/mensajes.php') ?>

<div class="flex flex-col items-center justify-center">

    <form action="../../controllers/UserController.php" method="POST">

        <label>Id de usuario:</label>
        <input type="hidden" id="textViewIdUsuario" name="newIdUser" value="<?php echo $userModifying['idUser']; ?>">
        <input type="text" id="textViewIdUsuario" name="newIdUser" value="<?php echo $userModifying['idUser']; ?>" disabled>

        <label>Nombre de usuario:</label>
        <input type="text" id="textViewNombreUsuario" value="<?php echo $userModifying['userName']; ?>" disabled>

        <label>Nombre:</label>
        <input type="text" id="textViewNombre" name="newName" value="<?php echo $userModifying['name']; ?>" required>

        <label>Apellido:</label>
        <input type="text" id="textViewApellido" name="newSurname" value="<?php echo $userModifying['surname']; ?>" required>

        <label>E-Mail:</label>
        <input type="email" id="textViewEmail" name="newEmail" value="<?php echo $userModifying['email']; ?>" required>

        <label>Rol de usuario:</label>
        <input type="hidden" id="textViewRolUsuario" name="newIdRole" value="<?php echo $userModifying['idRole']; ?>">
        <input type="text" id="textViewRolUsuario" name="newIdRole" value="<?php echo $userModifying['idRole']; ?>" disabled>

        <button type="submit" name="updateUser">Guardar cambios</button>

    </form>

</div>
    
</body>
</html>