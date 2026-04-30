<?php require_once "app/views/layout/header.php"; ?>

<h2>Crear producto</h2>

<?php if (isset($_SESSION["error"])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION["error"]; ?>
    </div>
    <?php unset($_SESSION["error"]); ?>
<?php endif; ?>

<form method="POST"
      action="index.php?controller=adminProducto&action=store"
      enctype="multipart/form-data"
      class="card p-4 shadow-sm">

    <div class="mb-3">
        <label>Nombre</label>
        <input name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion"
                  class="form-control"
                  required></textarea>
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number"
               name="precio"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <input name="categoria"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Imagen</label>
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
               required>
    </div>

    <button class="btn btn-success">
        Guardar producto
    </button>

</form>

<?php require_once "app/views/layout/footer.php"; ?>