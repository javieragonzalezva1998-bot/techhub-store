<?php require_once "app/views/layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title"><?php echo $producto["nombre"]; ?></h2>

        <?php if (!empty($producto["imagen"])): ?>
            <div class="mb-4 text-center">
                <img src="public/img/productos/<?php echo $producto["imagen"]; ?>"
                     alt="<?php echo $producto["nombre"]; ?>"
                     class="img-fluid"
                     style="max-height: 320px; object-fit: contain;" />
            </div>
        <?php endif; ?>

        <p class="card-text">
            <?php echo $producto["descripcion"]; ?>
        </p>

        <h4 class="fw-bold">
            $<?php echo number_format($producto["precio"], 0, ",", "."); ?>
        </h4>

        <p>
            <strong>Stock:</strong> <?php echo $producto["stock"]; ?>
        </p>

        <p>
            <strong>Categoría:</strong> <?php echo $producto["categoria"]; ?>
        </p>

        <a href="index.php" class="btn btn-secondary">Volver al catálogo</a>
        <a href="?controller=carrito&action=agregar&id=<?php echo $producto["id"]; ?>" 
        class="btn btn-success">
        Agregar al carrito
        </a>
    </div>
</div>

<?php require_once "app/views/layout/footer.php"; ?>