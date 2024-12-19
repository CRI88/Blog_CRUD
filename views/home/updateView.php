<?php
session_start();
require_once '../../models/Post.php';
require_once '../../config/Database.php';
require_once '../../controllers/PostController.php';

// Crear conexión y controlador
$database = new Database();
$db = $database->getConnection();
$postController = new PostController();

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $postController->updateView();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Post</title>
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

    <!-- Formulario para actualizar un post -->
    <form action="" method="POST">
        <input type="hidden" name="action" value="update">

        <label for="idPost">ID del Post:</label>
        <input type="number" id="idPost" name="idPost" required>

        <label for="title">Nuevo Título:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Nueva Descripción:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
