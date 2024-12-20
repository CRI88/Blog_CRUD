<?php

class User extends Database {

    private $conn;
    private $idUser;
    private $userName;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $idRole;

    public function __construct($db) {

        $this->conn = $db;

    }






    public function selectUserId($user, $idUser)
    {

        $sentenciaText = "SELECT idUser, userName, name, surname, email, password, idRole FROM Users WHERE idUser = :idUser";

        $sentencia = $user->conn->prepare($sentenciaText);

        $sentencia->bindParam(':idUser', $idUser);
        $sentencia->execute();

        //Devuelve un Objeto User
        $resultado = $sentencia->fetchObject(User::class);


        return $resultado;
    }

    public function selectAllUsers($user)
    {
        $sentenciaText = "SELECT idUser, userName, name, surname, email, password, idRole FROM Users";

        $sentencia = $user->conn->prepare($sentenciaText);
        $sentencia->execute();

        //Devuelve un array asociativo
        $resultado = $sentencia->fetchAll();


        return $resultado;
    }

    public function insertUser($user)
    {

        try {

            $sentenciaText = "INSERT INTO Users (userName, name, surname, email, password, idRole) VALUES (:userName, :name, :surname, :email, :password, :idRole)";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':userName', $user->userName);
            $sentencia->bindParam(':name', $user->name);
            $sentencia->bindParam(':surname', $user->surname);
            $sentencia->bindParam(':email', $user->email);
            $sentencia->bindParam(':password', $user->password);
            $sentencia->bindParam(':idRole', $user->idRole);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Registro insertado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function updateUser($user)
    {

        try {

            $sentenciaText = "UPDATE Users SET name = :newName, surname = :newSurname, email = :newEmail, idRole = :newIdRole WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':newName', $user->name);
            $sentencia->bindParam(':newSurname', $user->surname);
            $sentencia->bindParam(':newEmail', $user->email);
            $sentencia->bindParam(':newIdRole', $user->idRole);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Registro actualizado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function updateUserPassword($user)
    {

        try {

            $sentenciaText = "UPDATE Users SET password = :newPassword WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':newPassword', $user->password);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Contraseña actualizada correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function deleteUser($user)
    {

        try {

            $sentenciaText = "DELETE FROM Users WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Usuario eliminado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }
}

