<?php
include('../models/PostModel.php');

class PostController {

    public function index() {
        $postModel = new PostModel();

        $posts = $postModel->getAllPosts();

        include('../views/home/index.php');
    }
}
