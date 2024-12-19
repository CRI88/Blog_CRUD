<?php
session_start();
require_once '../../models/Post.php';
require_once '../../config/Database.php';
require_once '../../controllers/PostController.php';

$idPost = $_GET['idPostDeleting'];
echo $idPost;

// Crear conexión y controlador
$database = new Database();
$db = $database->getConnection();
$postController = new PostController();

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $postController->deleteView();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) 
{
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Post</title>
</head>
<body>
    <!-- Mostrar mensajes de éxito o error -->
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p style='color:green'>{$_SESSION['mensaje']}</p>";
        unset($_SESSION['mensaje']);
    }

    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Formulario para eliminar un post -->
    <form action="" method="POST">
        <!--<input type="hidden" name="action" value="delete">-->

        <input type="hidden" name="idPost" value="<?php echo $idPost ?>">

        <h1>¿Está seguro de eliminar el post seleccionado?</h1>

        <button type="submit" name="redirect">Cancelar</button>
        <button type="submit" name="action">Eliminar</button>
    </form>
</body>
</html>
