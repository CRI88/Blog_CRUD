<?php

require_once('../../config/Database.php');
require_once('../../models/Post.php');
require_once('../../controllers/PostController.php');

$idPost = $_GET['idPost'];

$db = (new Database()) ->getConnection();
$post = new Post($db);
$postController = new PostController();

$resultado = $post->readFromId($idPost);

var_dump($resultado);

//$listaComentarios = 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $resultado['title'] ?> </title>
</head>
<body>

    <h5> Usuario: <?php echo $resultado['userName'] ?> </h5>

    <h1> Titulo: <?php echo $resultado['title'] ?> </h1>

    <h3> Descripción:  <?php echo $resultado['description'] ?> </h3>


    <?php foreach ($variable as $key => $value) {
        # code...
    } ?>
    
</body>
</html>