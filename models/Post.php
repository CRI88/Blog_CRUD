<?php

//require_once ('../config/Database.php');
class Post
{
    private $conn;
    private $table_name = 'posts';
    public $idPost;
    public $userName;
    public $title;
    public $description;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Leer todos los posts
    public function read()
    {
        //$query = 'SELECT * FROM ' . $this->table_name .  ' ORDER BY idUser DESC';
        $query = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description 
        FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser ORDER BY userName"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Crear un nuevo post
    public function create($title, $idUser, $description)
    {
        // Implementa la lógica para insertar un post
        try
    {

        $sentenciaText = "INSERT INTO Posts (idUser, title, description) VALUES (:idUser, :title, :description)";

        $sentencia = $this->conn->prepare($sentenciaText);
        $sentencia->bindParam(':idUser', $idUser);
        $sentencia->bindParam(':title', $title);
        $sentencia->bindParam(':description', $description);


        $sentencia->execute();

        $_SESSION['mensaje'] = "Registro insertado correctamente";


    } catch (PDOException $e){
        $_SESSION['error'] = errorMessage($e);
    }
    }
    // Actualizar un post existente
    public function update($id, $title, $content, $author_id)
    {
        // Implementa la lógica para actualizar un post
        $query = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description 
        FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser ORDER BY userName"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Eliminar un post
    public function delete($id)
    {
        // Implementa la lógica para eliminar un post
        $query = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description 
        FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser ORDER BY userName"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}




/*require_once('CommentModel.php');

function selectAllPosts(){
    $conexion = openBd();

    $sentenciaText = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    //Devuelve un array
    $resultado = $sentencia->fetchAll();


    $conexion = closeBd();

    return $resultado;
}
function insertPost($idUser, $title, $description) {

    try
    {

        $conexion = openBd();

        $sentenciaText = "INSERT INTO Posts (idUser, title, description) VALUES (:idUser, :title, :description)";

        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idUser', $idUser);
        $sentencia->bindParam(':title', $title);
        $sentencia->bindParam(':description', $description);


        $sentencia->execute();

        $_SESSION['mensaje'] = "Registro insertado correctamente";


    } catch (PDOException $e){
        $_SESSION['error'] = errorMessage($e);
        
    }

    //Cerramos la conexion fuera del try catch, porque asi siempre se cerrara la conexión, haya ido bien o mal
    $conexion = closeBd();

}
function updatePost($idPost, $newTitle, $newDescription) {

    try
    {

        $conexion = openBd();

        $sentenciaText = "UPDATE Posts SET title = :newTitle, description = :newDescription WHERE idPost = :idPost";

        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':newTitle', $newTitle);
        $sentencia->bindParam(':newDescription', $newDescription);
        $sentencia->bindParam(':idPost', $idPost);

        $sentencia->execute();

        $_SESSION['mensaje'] = "Registro actualizado correctamente";


    } catch (PDOException $e){
        $_SESSION['error'] = errorMessage($e);
        
    }

    //Cerramos la conexion fuera del try catch, porque asi siempre se cerrara la conexión, haya ido bien o mal
    $conexion = closeBd();

}*/