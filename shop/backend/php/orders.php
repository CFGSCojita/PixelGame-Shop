
<!-- Llamada al header y conexión a la base de datos. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Pedidos</h1>

<!-- Enlaces a las diferentes operaciones para gestionar pedidos. -->
<a href="/student006/shop/backend/forms/form_order_insert.php">
    <span>Insertar Pedido</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_order_select.php">
    <span>Listar Pedidos</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_order_update_call.php">
    <span>Actualizar Pedido</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_order_delete_call.php">
    <span>Eliminar Pedido</span>
    <span>&gt;</span>
</a>
<br/>
<br/>
<!-- Enlace para volver al panel principal. -->
<a href="/student006/shop/backend/index.php">
    Volver al Panel Principal
</a>

<!-- Llamada al footer. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>