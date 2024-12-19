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