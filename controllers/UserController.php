<?php

session_start();

require_once('../config/Database.php');
require_once('../models/User.php');


if (isset($_POST['insert'])) {

    $db = (new Database())->getConnection();

    $user = new User($db);

    $user->setUserName($_POST['userName']);
    $user->setName($_POST['name']); 
    $user->setSurname($_POST['surname']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setIdRole($_POST['idRole']);


    //Cuando enviamos por post tiene que tener en name el nombre de la variable que queramos enviar
    $user->insertUser($user);

    //Si se produce un error lo mostramos
    if (isset($_SESSION['error'])) {

        //Si todo funciona correctamente mostramos todos los usuarios con el nuevo al final
    } else {

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/user');
        exit();

    }


} else if (isset($_POST['login'])) {

    $db = (new Database())->getConnection();

    $user = new User($db);

    $userResponse = $user->selectUserWithName($_POST['nombreUsuario']);

    if ($_POST['contrasenya'] === $userResponse->getPassword()){
        //La contrasenya es correcta


        switch ($userResponse->getIdRole()) {
            case 1:
                $_SESSION['idUser'] = $userResponse->getIdUser();
                header('Location: ../views/home/index.php');
                break;
            case 2:
                $_SESSION['idUser'] = $userResponse->getIdUser();
                header('Location: ../views/home/index.php');
                break;
            case 3:
                $_SESSION['idUser'] = $userResponse->getIdUser();
                header('Location: ../views/home/index.php');
                break;
        }


    } else {
        //La contrasenya no es correcta
        echo "La contrasenya no es correcta";
        header('Location: ../views/home/login.php');
    }


} elseif (isset($_POST['delete'])) {

}