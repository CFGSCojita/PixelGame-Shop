
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Actualizar Pedido</h1>
<p>Introduce el ID del pedido que deseas actualizar</p>

<!-- Formulario para introducir el ID del pedido a actualizar -->
<form action="/student006/shop/backend/forms/form_order_update.php" method="POST">
    <label for="order_id">ID del Pedido:</label>
    <input type="number" id="order_id" name="order_id" required>
    
    <button type="submit"">Buscar Pedido</button>
</form>

<!-- Enlace para volver a la lista de pedidos -->
<a href=" /student006/shop/backend/php/orders.php">
    ← Volver
</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>
