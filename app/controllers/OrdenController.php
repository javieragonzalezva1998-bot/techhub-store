<?php

require_once "app/models/Orden.php";

class OrdenController {

    public function historial() {
        if (!isset($_SESSION["usuario"])) {
            $_SESSION["error"] = "Debes iniciar sesión para ver tu historial.";
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }

        $ordenModel = new Orden();

        $ordenes = $ordenModel->obtenerHistorialPorUsuario(
            $_SESSION["usuario"]["id"]
        );

        require_once "app/views/orden/historial.php";
    }
}