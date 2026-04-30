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

    private function subirImagen($archivo) {
        if (!isset($archivo) || $archivo["error"] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($archivo["error"] !== UPLOAD_ERR_OK) {
            return null;
        }

        $validMime = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        $validExt = ["jpg", "jpeg", "png", "gif", "webp"];

        $info = getimagesize($archivo["tmp_name"]);
        if ($info === false || !in_array($info["mime"], $validMime)) {
            return null;
        }

        $extension = strtolower(pathinfo($archivo["name"], PATHINFO_EXTENSION));
        if (!in_array($extension, $validExt)) {
            return null;
        }

        $uploadsDir = dirname(__DIR__, 2) . "/public/img/productos/";
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $nombreArchivo = uniqid("prod_", true) . "." . $extension;
        $rutaDestino = $uploadsDir . $nombreArchivo;

        if (move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
            return $nombreArchivo;
        }

        return null;
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

        $imagen = null;
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] !== UPLOAD_ERR_NO_FILE) {
            $imagen = $this->subirImagen($_FILES["imagen"]);
            if (!$imagen) {
                $_SESSION["error"] = "El archivo de imagen no es válido. Usa JPG, PNG, GIF o WEBP.";
                header("Location: index.php?controller=adminProducto&action=create");
                exit;
            }
        }
    
        $productoModel = new Producto();
    
        $productoModel->crear(
            $nombre,
            $descripcion,
            $precio,
            $categoria,
            $stock,
            $imagen
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
        $productoActual = $productoModel->obtenerProductoPorId($id);

        $imagen = null;
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] !== UPLOAD_ERR_NO_FILE) {
            $imagen = $this->subirImagen($_FILES["imagen"]);
            if (!$imagen) {
                $_SESSION["error"] = "El archivo de imagen no es válido. Usa JPG, PNG, GIF o WEBP.";
                header("Location: index.php?controller=adminProducto&action=edit&id={$id}");
                exit;
            }

            if (!empty($productoActual["imagen"])) {
                $rutaAntigua = dirname(__DIR__, 2) . "/public/img/productos/" . $productoActual["imagen"];
                if (file_exists($rutaAntigua)) {
                    unlink($rutaAntigua);
                }
            }
        }
    
        $productoModel->actualizar(
            $id,
            $nombre,
            $descripcion,
            $precio,
            $categoria,
            $stock,
            $imagen
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