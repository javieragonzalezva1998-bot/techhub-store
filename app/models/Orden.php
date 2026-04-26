<?php

require_once "config/database.php";
require_once "app/models/Producto.php";

class Orden {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function crearOrden($usuarioId, $carrito) {
        $productoModel = new Producto();
        $total = 0;

        foreach ($carrito as $productoId => $cantidad) {
            $producto = $productoModel->obtenerProductoPorId($productoId);
            $total += $producto["precio"] * $cantidad;
        }

        $sqlOrden = "INSERT INTO ordenes (usuario_id, total, estado) VALUES (?, ?, 'pagada')";
        $stmtOrden = $this->conn->prepare($sqlOrden);
        $stmtOrden->bind_param("id", $usuarioId, $total);
        $stmtOrden->execute();

        $ordenId = $this->conn->insert_id;

        foreach ($carrito as $productoId => $cantidad) {
            $producto = $productoModel->obtenerProductoPorId($productoId);
            $precio = $producto["precio"];
            $subtotal = $precio * $cantidad;

            $sqlDetalle = "INSERT INTO detalles_orden 
                (orden_id, producto_id, cantidad, precio_unitario, subtotal) 
                VALUES (?, ?, ?, ?, ?)";

            $stmtDetalle = $this->conn->prepare($sqlDetalle);
            $stmtDetalle->bind_param("iiidd", $ordenId, $productoId, $cantidad, $precio, $subtotal);
            $stmtDetalle->execute();
        }

        return $ordenId;
    }

    public function obtenerHistorialPorUsuario($usuarioId) {
        $sql = "SELECT 
                    o.id AS orden_id,
                    o.total,
                    o.estado,
                    o.creado_en,
                    p.nombre AS producto_nombre,
                    d.cantidad,
                    d.precio_unitario,
                    d.subtotal
                FROM ordenes o
                INNER JOIN detalles_orden d ON o.id = d.orden_id
                INNER JOIN productos p ON d.producto_id = p.id
                WHERE o.usuario_id = ?
                ORDER BY o.creado_en DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();

        return $stmt->get_result();
    }
}