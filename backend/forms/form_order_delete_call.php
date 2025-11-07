
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Pedido</h1>
<p>Introduce el ID del pedido que deseas eliminar</p>

<!-- Formulario para buscar el pedido -->
<form action="/student006/shop/backend/forms/form_order_delete.php" method="POST">
    <label for="order_id">ID del Pedido:</label>
    <input type="number" id="order_id" name="order_id" required min="1" title="Introduce solo un número de ID (ej: 2). Debe ser un entero positivo.">
    
    <button type="submit"">Buscar Pedido</button>
</form>  

<!-- Enlace para volver a la lista de pedidos -->
<a href=" /student006/shop/backend/php/orders.php">
    ← Volver a Pedidos
</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
	$root_DIR = $_SERVER['DOCUMENT_ROOT'];
	require($root_DIR . '/student006/shop/backend/php/footer.php');
?>