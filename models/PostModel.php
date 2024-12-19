<?php


require_once('CommentModel.php');

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

}