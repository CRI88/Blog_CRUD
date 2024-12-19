<?php

//require_once ('../config/Database.php');
class User
{
    private $conn;
    private $table_name = 'posts';
    public $idPost;
    public $idUser;
    public $title;
    public $description;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Leer todos los posts
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' ORDER BY idUser DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Crear un nuevo post
    public function create($title, $content, $author_id)
    {
        // Implementa la lógica para insertar un post
    }
    // Actualizar un post existente
    public function update($id, $title, $content, $author_id)
    {
        // Implementa la lógica para actualizar un post
    }
    // Eliminar un post
    public function delete($id)
    {
        // Implementa la lógica para eliminar un post
    }
}



