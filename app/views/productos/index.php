<?php require_once "app/views/layout/header.php"; ?>

<h2 class="mb-4">Catálogo de productos</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <input
            type="text"
            id="buscador"
            class="form-control"
            placeholder="Buscar productos..."
        >
    </div>
</div>

<div id="mensaje-carrito"></div>

<div id="contenedor-productos" class="row g-4">

<?php if ($productos instanceof mysqli_result && $productos->num_rows > 0) { ?>

    <?php while ($producto = $productos->fetch_assoc()) { ?>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">

                <?php if (!empty($producto["imagen"])): ?>
                    <img
                        src="public/img/productos/<?= $producto["imagen"]; ?>"
                        class="card-img-top"
                        alt="<?= $producto["nombre"]; ?>"
                        style="height: 180px; object-fit: contain; padding: 15px;"
                    >
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title">
                        <?= $producto["nombre"]; ?>
                    </h5>

                    <p class="card-text">
                        <?= $producto["descripcion"]; ?>
                    </p>

                    <p class="fw-bold">
                        $<?= number_format($producto["precio"], 0, ",", "."); ?>
                    </p>

                    <a class="btn btn-primary" href="index.php?controller=producto&action=show&id=<?= $producto["id"]; ?>">
                        Ver detalle
                    </a>

                    <button
                        class="btn btn-success btn-agregar-carrito"
                        data-id="<?= $producto["id"]; ?>">
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>

    <?php } ?>

<?php } else { ?>

    <p>No hay productos registrados todavía.</p>

<?php } ?>

</div>

<script>
document.getElementById("buscador").addEventListener("keyup", function() {
    const termino = this.value;

    fetch("index.php?controller=producto&action=buscarAjax&q=" + encodeURIComponent(termino))
        .then(response => response.json())
        .then(data => {
            let html = "";

            if (data.length === 0) {
                html = `
                    <div class="col-12">
                        <div class="alert alert-warning">
                            No se encontraron productos.
                        </div>
                    </div>
                `;
            }

            data.forEach(producto => {
                const precio = Number(producto.precio).toLocaleString("es-CL");

                html += `
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">

                            ${producto.imagen ? `
                                <img 
                                    src="public/img/productos/${producto.imagen}" 
                                    class="card-img-top" 
                                    alt="${producto.nombre}"
                                    style="height: 180px; object-fit: contain; padding: 15px;"
                                >
                            ` : ""}

                            <div class="card-body">
                                <h5 class="card-title">${producto.nombre}</h5>

                                <p class="card-text">${producto.descripcion}</p>

                                <p class="fw-bold">$${precio}</p>

                                <a class="btn btn-primary" href="index.php?controller=producto&action=show&id=${producto.id}">
                                    Ver detalle
                                </a>

                                <button 
                                    class="btn btn-success btn-agregar-carrito"
                                    data-id="${producto.id}">
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });

            document.getElementById("contenedor-productos").innerHTML = html;
        });
});

document.addEventListener("click", function(e) {
    if (e.target.classList.contains("btn-agregar-carrito")) {
        const productoId = e.target.dataset.id;

        fetch("index.php?controller=carrito&action=agregar&ajax=1&id=" + productoId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("btn-carrito").innerHTML = `🛒 Carrito (${data.totalCarrito})`;

                    document.getElementById("mensaje-carrito").innerHTML = `
                        <div class="alert alert-success">
                            ${data.message}
                        </div>
                    `;

                    setTimeout(() => {
                        document.getElementById("mensaje-carrito").innerHTML = "";
                    }, 2000);
                }
            });
    }
});
</script>

<?php require_once "app/views/layout/footer.php"; ?>