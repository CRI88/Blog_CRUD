<?php

    require_once('../../config/Database.php');
    require_once('../../models/UserModel.php');

    $id = $_GET['id'];

    //Consulta a la base de datos
    $userDeleting = selectUserId($id);

    var_dump($userDeleting);

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

<div class="floating-div">
        <form action="../../controllers/UserController.php" method="POST">

            <h2>Mensaje</h2>
            <h5>¿Esta seguro de eliminar el usuario
                <?php echo $userDeleting['userName'] ?>
            </h5>
            <input type="hidden" id="textViewIdUsuario" name="idUser"
                value="<?php echo $userDeleting['idUser'] ?>">


            <button type="submit" name="deleteUser">Si</button>
            <button type="submit" name="redirectDashboard">Cancelar</button>

        </form>
    </div>

</div>
    
</body>
</html>