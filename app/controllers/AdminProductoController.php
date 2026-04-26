<?php

require_once "app/models/Producto.php";

class AdminProductoController {

    private function validarAdmin() {
        if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["rol"] !== "admin") {
            $_SESSION["error"] = "No tienes permisos para acceder al panel administrador.";
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }
    }

    public function index() {
        
        $this->validarAdmin();

        $productoModel = new Producto();
        $productos = $productoModel->obtenerProductos();

        require_once "app/views/admin/productos/index.php";
    }

    public function create() {
        $this->validarAdmin();
    
        require_once "app/views/admin/productos/create.php";
    }

    public function store() {
        $this->validarAdmin();
    
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $categoria = $_POST["categoria"];
        $stock = $_POST["stock"];
    
        $productoModel = new Producto();
    
        $productoModel->crear(
            $nombre,
            $descripcion,
            $precio,
            $categoria,
            $stock
        );
    
        header("Location: index.php?controller=adminProducto&action=index");
        exit;
    }

    public function edit() {

        $this->validarAdmin();
    
        if (!isset($_GET["id"])) {
            header("Location: index.php?controller=adminProducto&action=index");
            exit;
        }
    
        $productoModel = new Producto();
    
        $producto = $productoModel->obtenerProductoPorId($_GET["id"]);
    
        require_once "app/views/admin/productos/edit.php";
    }

    public function update() {

        $this->validarAdmin();
    
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $categoria = $_POST["categoria"];
        $stock = $_POST["stock"];
    
        $productoModel = new Producto();
    
        $productoModel->actualizar(
            $id,
            $nombre,
            $descripcion,
            $precio,
            $categoria,
            $stock
        );
    
        header("Location: index.php?controller=adminProducto&action=index");
        exit;
    }

    public function delete() {

        $this->validarAdmin();
    
        if (!isset($_GET["id"])) {
            header("Location: index.php?controller=adminProducto&action=index");
            exit;
        }
    
        $productoModel = new Producto();
    
        $productoModel->eliminar($_GET["id"]);
    
        header("Location: index.php?controller=adminProducto&action=index");
        exit;
    }
}