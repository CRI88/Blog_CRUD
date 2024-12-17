<?php

session_start();

require_once('../../config/Database.php');


function selectUsers(){
    $conexion = openBd();

    $sentenciaText = "SELECT * from Users";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    //Devuelve un array
    $resultado = $sentencia->fetchAll();


    $conexion = closeBd();

    return $resultado;
}

function insertUser($userName, $name, $surname, $email, $password, $idRole) {

    try
    {

        $conexion = openBd();

        $sentenciaText = "INSERT INTO Users (userName, name, surname, email, password, idRole) VALUES (:userName, :name, :surname, :email, :password, :idRole)";

        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':userName', $userName);
        $sentencia->bindParam(':name', $name);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':password', $password);
        $sentencia->bindParam(':idRole', $idRole);

        $sentencia->execute();

        $_SESSION['mensaje'] = "Registro insertado correctamente";
       

    } catch (PDOException $e){
        $_SESSION['error'] = errorMessage($e);

    }

    //Cerramos la conexion fuera del try catch, porque asi siempre se cerrara la conexión, haya ido bien o mal
    $conexion = closeBd();

    

}