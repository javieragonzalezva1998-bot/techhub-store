<?php

require_once "app/models/Producto.php";

class ProductoController {
    public function index() {
        $productoModel = new Producto();
        $productos = $productoModel->obtenerProductos();

        require_once "app/views/productos/index.php";
    }

    public function show() {
        if (!isset($_GET["id"])) {
            echo "Producto no encontrado";
            return;
        }

        $id = $_GET["id"];

        $productoModel = new Producto();
        $producto = $productoModel->obtenerProductoPorId($id);

        require_once "app/views/productos/show.php";
    }

    public function buscarAjax() {
        $termino = $_GET["q"] ?? "";

        $productoModel = new Producto();
        $productos = $productoModel->buscarProductos($termino);

        header("Content-Type: application/json");

        $data = [];

        while ($producto = $productos->fetch_assoc()) {
            $data[] = $producto;
        }

        echo json_encode($data);
    }
}