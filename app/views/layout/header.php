<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TechHub Store</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php
$totalCarrito = 0;

if (isset($_SESSION["carrito"])) {
    foreach ($_SESSION["carrito"] as $cantidad) {
        $totalCarrito += $cantidad;
    }
}
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">TechHub Store</a>

        <div class="d-flex gap-2 align-items-center">

            <?php if (isset($_SESSION["usuario"])): ?>

                <span class="text-white">
                    Hola <?= $_SESSION["usuario"]["nombre"]; ?>
                </span>

                <?php if ($_SESSION["usuario"]["rol"] === "admin"): ?>

                    <a href="index.php?controller=adminProducto&action=index" class="btn btn-outline-light">
                        Panel admin
                    </a>

                <?php else: ?>

                    <a href="index.php?controller=orden&action=historial" class="btn btn-outline-light">
                        Historial
                    </a>

                <?php endif; ?>

                <a href="index.php?controller=auth&action=logout" class="btn btn-outline-light">
                    Cerrar sesión
                </a>

            <?php else: ?>

                <a href="index.php?controller=auth&action=loginForm" class="btn btn-outline-light">
                    Login
                </a>

            <?php endif; ?>

            <a id="btn-carrito" class="btn btn-outline-light" href="index.php?controller=carrito&action=index">
                🛒 Carrito (<?= $totalCarrito; ?>)
            </a>

        </div>
    </div>
</nav>

<main class="container my-4">