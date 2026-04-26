<?php require_once "app/views/layout/header.php"; ?>

<h2>Crear producto</h2>

<form method="POST"
      action="index.php?controller=adminProducto&action=store"
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