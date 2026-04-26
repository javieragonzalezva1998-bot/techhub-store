<?php require_once "app/views/layout/header.php"; ?>

<h2>Panel administrador - Productos</h2>

<a href="index.php?controller=adminProducto&action=create" class="btn btn-success mb-3">
    Crear producto
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($producto = $productos->fetch_assoc()): ?>
            <tr>
                <td><?= $producto["id"]; ?></td>
                <td><?= $producto["nombre"]; ?></td>
                <td><?= $producto["categoria"]; ?></td>
                <td>$<?= number_format($producto["precio"], 0, ",", "."); ?></td>
                <td><?= $producto["stock"]; ?></td>
                <td>
                    <a href="index.php?controller=adminProducto&action=edit&id=<?= $producto["id"]; ?>" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a href="index.php?controller=adminProducto&action=delete&id=<?= $producto["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require_once "app/views/layout/footer.php"; ?>