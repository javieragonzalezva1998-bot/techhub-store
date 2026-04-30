<?php

require_once "config/database.php";

class Producto {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerProductos() {
        $sql = "SELECT * FROM productos";
        $resultado = $this->conn->query($sql);

        return $resultado;
    }

    public function getById($id) {
        $id = intval($id);
    
        $sql = "SELECT * FROM productos WHERE id = $id";
        $resultado = $this->conn->query($sql);
    
        return $resultado->fetch_assoc();
    }
    
    public function obtenerProductoPorId($id) {
        return $this->getById($id);
    }

    public function buscarProductos($termino) {
        $termino = "%" . $termino . "%";
    
        $sql = "SELECT * FROM productos 
                WHERE nombre LIKE ? 
                OR descripcion LIKE ? 
                OR categoria LIKE ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $termino, $termino, $termino);
        $stmt->execute();
    
        return $stmt->get_result();
    }

    public function crear($nombre, $descripcion, $precio, $categoria, $stock, $imagen = null) {

        $sql = "INSERT INTO productos
                (nombre, descripcion, precio, categoria, stock, imagen)
                VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bind_param(
            "ssdsis",
            $nombre,
            $descripcion,
            $precio,
            $categoria,
            $stock,
            $imagen
        );
    
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $categoria, $stock, $imagen = null) {
        if ($imagen !== null) {
            $sql = "UPDATE productos
                    SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, stock = ?, imagen = ?
                    WHERE id = ?";
    
            $stmt = $this->conn->prepare($sql);
    
            $stmt->bind_param(
                "ssdsisi",
                $nombre,
                $descripcion,
                $precio,
                $categoria,
                $stock,
                $imagen,
                $id
            );
        } else {
            $sql = "UPDATE productos
                    SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, stock = ?
                    WHERE id = ?";
    
            $stmt = $this->conn->prepare($sql);
    
            $stmt->bind_param(
                "ssdsii",
                $nombre,
                $descripcion,
                $precio,
                $categoria,
                $stock,
                $id
            );
        }
    
        return $stmt->execute();
    }

    

    public function eliminar($id) {

        $sql = "DELETE FROM productos WHERE id = ?";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bind_param("i", $id);
    
        return $stmt->execute();
    }
}