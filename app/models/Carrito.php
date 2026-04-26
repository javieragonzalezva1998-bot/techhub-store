<?php

class Carrito {

    public static function agregar($producto_id) {

        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }

        if (isset($_SESSION["carrito"][$producto_id])) {
            $_SESSION["carrito"][$producto_id]++;
        } else {
            $_SESSION["carrito"][$producto_id] = 1;
        }
    }

    public static function eliminar($producto_id) {

        if (isset($_SESSION["carrito"][$producto_id])) {
            unset($_SESSION["carrito"][$producto_id]);
        }
    
    }

    public static function vaciar() {
        unset($_SESSION["carrito"]);
    }
}