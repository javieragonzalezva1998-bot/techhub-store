<?php require_once "app/views/layout/header.php"; ?>

<h2 class="mb-4">Carrito de compras</h2>

<?php if (!empty($productos)) { ?>

<table class="table">

<thead>
<tr>
<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Total</th>
<th>Acción</th>
</tr>
</thead>

<tbody>

<?php
$totalGeneral = 0;

foreach ($productos as $producto) {

$total = $producto["precio"] * $producto["cantidad"];
$totalGeneral += $total;
?>

<tr>

<td><?php echo $producto["nombre"]; ?></td>

<td>
$<?php echo number_format($producto["precio"], 0, ",", "."); ?>
</td>

<td><?php echo $producto["cantidad"]; ?></td>

<td>
$<?php echo number_format($total, 0, ",", "."); ?>
</td>

<td>
<a href="?controller=carrito&action=eliminar&id=<?php echo $producto["id"]; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar este producto del carrito?')">
Eliminar
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<h4 class="mt-4">
Total: $<?php echo number_format($totalGeneral, 0, ",", "."); ?>
</h4>

<div class="mt-3">

<a href="?controller=carrito&action=vaciar"
class="btn btn-warning"
onclick="return confirm('¿Seguro que deseas vaciar el carrito?')">
Vaciar carrito
</a>

<a href="index.php?controller=carrito&action=finalizar" class="btn btn-success">
    Finalizar compra
</a>

<a href="index.php"
class="btn btn-primary">
Seguir comprando
</a>



</div>

<?php } else { ?>

<p>Tu carrito está vacío</p>

<a href="index.php"
class="btn btn-primary">
Volver al catálogo
</a>



<?php } ?>

<?php require_once "app/views/layout/footer.php"; ?>