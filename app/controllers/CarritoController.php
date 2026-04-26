<?php

require_once "app/models/Carrito.php";
require_once "app/models/Producto.php";
require_once "app/models/Orden.php";

class CarritoController {

    public function agregar() {
        if (isset($_GET["id"])) {
            Carrito::agregar($_GET["id"]);
        }
    
        if (isset($_GET["ajax"]) && $_GET["ajax"] == "1") {
            $totalCarrito = 0;
    
            if (isset($_SESSION["carrito"])) {
                foreach ($_SESSION["carrito"] as $cantidad) {
                    $totalCarrito += $cantidad;
                }
            }
    
            header("Content-Type: application/json");
    
            echo json_encode([
                "success" => true,
                "message" => "Producto agregado al carrito",
                "totalCarrito" => $totalCarrito
            ]);
    
            exit;
        }
    
        header("Location: index.php");
        exit;
    }

    public function index() {
        $carrito = $_SESSION["carrito"] ?? [];
        $productos = [];

        if (!empty($carrito)) {
            $productoModel = new Producto();

            foreach ($carrito as $id => $cantidad) {
                $producto = $productoModel->getById($id);
                $producto["cantidad"] = $cantidad;
                $productos[] = $producto;
            }
        }

        require_once "app/views/carrito/index.php";
    }

    public function eliminar() {
        if (isset($_GET["id"])) {
            Carrito::eliminar($_GET["id"]);
        }

        header("Location: index.php?controller=carrito&action=index");
        exit;
    }

    public function vaciar() {
        Carrito::vaciar();

        header("Location: index.php?controller=carrito&action=index");
        exit;
    }

    public function finalizar() {
        if (!isset($_SESSION["usuario"])) {
            $_SESSION["error"] = "Debes iniciar sesión para finalizar la compra.";
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }

        if (empty($_SESSION["carrito"])) {
            header("Location: index.php?controller=carrito&action=index");
            exit;
        }

        $ordenModel = new Orden();

        $ordenId = $ordenModel->crearOrden(
            $_SESSION["usuario"]["id"],
            $_SESSION["carrito"]
        );

        Carrito::vaciar();

        $_SESSION["success"] = "Compra realizada correctamente. Orden #" . $ordenId;

        header("Location: index.php?controller=orden&action=historial");
        exit;
    }
}