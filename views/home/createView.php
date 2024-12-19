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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController->createView();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Post</title>
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

    <!-- Formulario -->
    <form action="" method="POST">
        <label for="idUser">Usuario ID:</label>
        <input type="number" id="idUser" name="idUser" required>

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Insertar</button>
    </form>
</body>
</html>
