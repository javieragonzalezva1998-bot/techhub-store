<?php

require_once "app/models/Usuario.php";

class AuthController {

    public function loginForm() {
        require "app/views/auth/login.php";
    }

    public function registerForm() {
        require "app/views/auth/register.php";
    }

    public function login() {
        $usuarioModel = new Usuario();

        $usuario = $usuarioModel->login(
            $_POST["email"],
            $_POST["password"]
        );

        if ($usuario) {
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
            exit;
        }

        $_SESSION["error"] = "Credenciales incorrectas";
        header("Location: index.php?controller=auth&action=loginForm");
        exit;
    }

    public function register() {
        $usuarioModel = new Usuario();

        $nombre = trim($_POST["nombre"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($nombre === "" || $email === "" || $password === "") {
        $_SESSION["error"] = "Todos los campos son obligatorios.";
        header("Location: index.php?controller=auth&action=registerForm");
        exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "El correo ingresado no es válido.";
        header("Location: index.php?controller=auth&action=registerForm");
        exit;
        }

        if (strlen($password) < 6) {
        $_SESSION["error"] = "La contraseña debe tener al menos 6 caracteres.";
        header("Location: index.php?controller=auth&action=registerForm");
        exit;
        }

        if ($usuarioModel->buscarPorEmail($email)) {
            $_SESSION["error"] = "Este correo ya está registrado";
            header("Location: index.php?controller=auth&action=registerForm");
            exit;
        }
        
        if (strlen($password) < 6) {
            $_SESSION["error"] = "La contraseña debe tener al menos 6 caracteres.";
            header("Location: index.php?controller=auth&action=registerForm");
            exit;
        }
            $registrado = $usuarioModel->registrar(
                $nombre,
                $email,
                $password
        );
        
        if ($registrado) {
            $_SESSION["success"] = "Usuario registrado correctamente. Ahora inicia sesión.";
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }
        
        $_SESSION["error"] = "No se pudo registrar el usuario.";
        header("Location: index.php?controller=auth&action=registerForm");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}