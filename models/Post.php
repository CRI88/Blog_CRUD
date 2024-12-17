<?php

namespace models;

class Post
{
    private $conn;
    // Propiedades del post (id, title, content, etc.)
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Métodos CRUD para los posts
}