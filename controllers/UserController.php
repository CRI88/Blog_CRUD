<?php

session_start();

require_once('../config/Database.php');


if (isset($_POST['insert'])) {

    //Cuando enviamos por post tiene que tener en name el nombre de la variable que queramos enviar
    insertUser($_POST['userName'], $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['idRole']);

    //Si se produce un error lo mostramos
    if (isset($_SESSION['error'])) {

    //Si todo funciona correctamente mostramos todos los usuarios con el nuevo al final
    } else {

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/user');
        exit();

    }


} 
else if (isset($_POST['login'])) {

}
elseif (isset($_POST['delete'])) {

}