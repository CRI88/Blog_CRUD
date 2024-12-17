<?php

include('../config/Database.php');

class PostModel {
    
    public function getAllPosts() {
        try {
            $conexion = openBd();
            if ($conexion) {
                $sql = "SELECT title, description, idUser FROM posts";
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return [];
        } catch (PDOException $e) {
            echo "Error al obtener publicaciones: " . $e->getMessage();
            return [];
        }
    }
}
?>
