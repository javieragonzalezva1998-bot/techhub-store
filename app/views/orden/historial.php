<?php require "app/views/layout/header.php"; ?>

<h2>Historial de compras</h2>

<?php if ($ordenes->num_rows > 0): ?>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Orden</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($orden = $ordenes->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $orden["orden_id"]; ?></td>
                    <td><?= $orden["creado_en"]; ?></td>
                    <td><?= $orden["producto_nombre"]; ?></td>
                    <td><?= $orden["cantidad"]; ?></td>
                    <td>$<?= number_format($orden["precio_unitario"], 0, ",", "."); ?></td>
                    <td>$<?= number_format($orden["subtotal"], 0, ",", "."); ?></td>
                    <td><?= ucfirst($orden["estado"]); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php else: ?>

    <div class="alert alert-info mt-3">
        Aún no tienes compras registradas.
    </div>

<?php endif; ?>

<a href="index.php" class="btn btn-primary">
    Volver al catálogo
</a>

<?php require "app/views/layout/footer.php"; ?>