<?php

require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../config/Database.php';
class PostController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Post($db);
    }
    // Mostrar la página principal con todos los posts
    public function index()
    {
        $result = $this->model->read();
        $postArr = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $postItem = [
                'idPost' => $idPost,
                'userName' => $userName,
                'title' => $title,
                'description' => $description
            ];
            $postArr[] = $postItem;
        }

        return $postArr;
        //require_once '../views/home/index.php';
    }

    /*public function createView()
    {
        $this->model->create("hola", 6, "hjhjbkh");
        
        //require_once '../views/home/index.php';
    }*/

    public function createView()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $idUser = $_POST['idUser'] ?? 0;
        $description = $_POST['description'] ?? '';

        if (empty($title) || empty($description) || !$idUser) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            return;
        }

        $this->model->create($title, $idUser, $description);

        header('Location: ../../views/home/index.php');
        exit();
    }
}

public function updateView()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPost = $_POST['idPost'] ?? null;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($title) || empty($description)) {
                $_SESSION['error'] = "Todos los campos son obligatorios.";
                return;
            }

            if ($this->model->update($idPost, $title, $description)) {
                $_SESSION['mensaje'] = "Post actualizado correctamente.";
            } else {
                $_SESSION['error'] = "Error al actualizar el post.";
            }

            header('Location: ../../views/home/index.php');
            exit();
        }
    }

    public function deleteView()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPost = $_POST['idPost'] ?? null;

            if (empty($idPost)) {
                $_SESSION['error'] = "ID del post es obligatorio.";
                return;
            }

            if ($this->model->delete($idPost)) {
                $_SESSION['mensaje'] = "Post eliminado correctamente.";
            } else {
                $_SESSION['error'] = "Error al eliminar el post.";
            }
            header('Location: ../../views/home/index.php');
            exit();
        }
    }

}





/*namespace controllers;

use models\PostModel;

class PostController {
    
    public function index() {
        $postModel = new PostModel();

        $posts = $postModel->getAllPosts();
        var_dump($posts);

        include('../views/home/index.php');
    }
}*/
?>