<?php
    include('../../controllers/PostController.php');

    $postController = new PostController();

    $postController->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link href="../../output.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-blue-600 text-white py-6">
        <h1 class="text-center text-4xl font-bold">Blog de Comida</h1>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white border rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($post['description']); ?></p>
                    <p class="text-sm text-gray-500">Publicado por Usuario ID: <span class="font-semibold"><?php echo htmlspecialchars($post['idUser']); ?></span></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="bg-gray-800 text-white py-4">
        <p class="text-center">&copy; <?php echo date('Y'); ?> Blog de Comida. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
