
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Añadir Pedido</h1>

<form action="/student006/shop/backend/db/db_order_insert.php" method="POST">
    
    <label for="user_id">ID del Usuario:</label>
    <input type="number" id="user_id" name="user_id" required>
    <br/>
    <br/>
    <label for="videogame_id">ID del Videojuego:</label>
    <input type="number" id="videogame_id" name="videogame_id" required>
    <br/>
    <br/>
    <label for="quantity">Cantidad:</label>
    <input type="text" id="quantity" name="quantity" maxlength="200">
    <br/>
    <br/>
    <label for="unit_price">Precio por unidad:</label>
    <input type="text" id="unit_price" name="unit_price" maxlength="200">
    <br/>
    <br/>
    <label for="total">Total:</label>
    <input type="text" id="total" name="total" maxlength="200">
    <br/>
    <br/>
    <label for="order_date">Fecha del pedido:</label>
    <input type="text" id="order_date" name="order_date" maxlength="200">
    <br/>
    <br/>
    <button type="submit">Añadir</button>
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>