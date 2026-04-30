<?php require_once "app/views/layout/header.php"; ?>

<h2>Editar producto</h2>

<?php if (isset($_SESSION["error"])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION["error"]; ?>
    </div>
    <?php unset($_SESSION["error"]); ?>
<?php endif; ?>

<form method="POST"
      action="index.php?controller=adminProducto&action=update"
      enctype="multipart/form-data"
      class="card p-4 shadow-sm">

    <input type="hidden"
           name="id"
           value="<?= $producto["id"]; ?>">

    <div class="mb-3">
        <label>Nombre</label>
        <input name="nombre"
               class="form-control"
               value="<?= $producto["nombre"]; ?>"
               required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion"
                  class="form-control"
                  required><?= $producto["descripcion"]; ?></textarea>
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number"
               name="precio"
               class="form-control"
               value="<?= $producto["precio"]; ?>"
               required>
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <input name="categoria"
               class="form-control"
               value="<?= $producto["categoria"]; ?>"
               required>
    </div>

    <div class="mb-3">
        <label>Imagen actual</label>
        <?php if (!empty($producto["imagen"])): ?>
            <div class="mb-2">
                <img src="public/img/productos/<?= $producto["imagen"]; ?>"
                     alt="<?= $producto["nombre"]; ?>"
                     style="max-height: 150px; object-fit: contain;" />
            </div>
        <?php else: ?>
            <div class="text-muted">No hay imagen cargada.</div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label>Subir nueva imagen</label>
        <input type="file"
               name="imagen"
               accept="image/*"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number"
               name="stock"
               class="form-control"
               value="<?= $producto["stock"]; ?>"
               required>
    </div>

    <button class="btn btn-warning">
        Actualizar producto
    </button>

</form>

<?php require_once "app/views/layout/footer.php"; ?>