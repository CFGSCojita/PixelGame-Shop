
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Consulta Simple de Pedidos</h1>

<!-- Formulario para listar todos los pedidos -->
<form action="/student006/shop/backend/db/db_order_select.php" method="POST">
    
    <p>Presiona el botón para listar todos los pedidos en la base de datos.</p>
    
    <input type="submit" value="Mostrar Pedidos">
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>