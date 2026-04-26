<?php require_once "app/views/layout/header.php"; ?>

<h2>Editar producto</h2>

<form method="POST"
      action="index.php?controller=adminProducto&action=update"
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