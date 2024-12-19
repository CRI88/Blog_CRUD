<?php
require_once('../../config/Database.php');
require_once('../../models/Post.php');
require_once('../../controllers/PostController.php');

$db = (new Database()) ->getConnection();
$post = new Post($db);
$postController = new PostController();

$resultado = $postController->index();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones - Blog</title>
    <link href="../../output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-6">
        <h1 class="text-center text-4xl font-bold">Blog de Comida</h1>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($resultado)): ?>
                <?php foreach ($resultado as $post): ?>
                    <div class="bg-white border rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($post['description']); ?></p>
                        <p class="text-sm text-gray-500">Publicado por Usuario: <span class="font-semibold"><?php echo htmlspecialchars($post['userName']); ?></span></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-lg text-gray-500">No hay publicaciones disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <p class="text-center">&copy; <?php echo date('Y'); ?> Blog de Comida. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
