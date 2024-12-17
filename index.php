<?php

use models\User;

$instanciaUsuarios = new User();

$listaUsuarios = $instanciaUsuarios->getAllUsers();

var_dump($listaUsuarios);

