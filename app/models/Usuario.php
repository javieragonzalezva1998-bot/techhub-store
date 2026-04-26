<?php

require_once "config/database.php";

class Usuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrar($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $rol = "cliente";

        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $passwordHash, $rol);

        return $stmt->execute();
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }

    public function login($email, $password) {
        $usuario = $this->buscarPorEmail($email);

        if (!$usuario) {
            return false;
        }

        if (password_verify($password, $usuario["password"])) {
            return $usuario;
        }

        return false;
    }
}