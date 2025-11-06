<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $order_id = $_POST['order_id']; // Obtenemos el ID del pedido desde el formulario.

    $sql = "SELECT * FROM 006_orders WHERE order_id = $order_id"; // Consultamos para obtener los datos del pedido.
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.
    $order = mysqli_fetch_assoc($result); // Obtenemos los datos del pedido.
?>

<h1>Actualizar Pedido</h1>

<!-- Formulario para actualizar los datos del pedido -->
<form action="/student006/shop/backend/db/db_order_update.php" method="POST">
    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

    <label for="user_id">ID del Usuario:</label>
    <input type="number" id="user_id" name="user_id" value="<?php echo $order['user_id']; ?>" required>
    <br/>
    <br/>
    <label for="videogame_id">ID del Videojuego:</label>
    <input type="number" id="videogame_id" name="videogame_id" value="<?php echo $order['videogame_id']; ?>" required>
    <br/>
    <br/>
    <label for="quantity">Cantidad:</label>
    <input type="text" id="quantity" name="quantity" maxlength="200" value="<?php echo $order['quantity']; ?>">
    <br/>
    <br/>
    <label for="unit_price">Precio por unidad:</label>
    <input type="text" id="unit_price" name="unit_price" maxlength="200" value="<?php echo $order['unit_price']; ?>">
    <br/>
    <br/>
    <label for="total">Total:</label>
    <input type="text" id="total" name="total" maxlength="200" value="<?php echo $order['total']; ?>">
    <br/>
    <br/>
    <label for="order_date">Fecha del pedido:</label>
    <input type="text" id="order_date" name="order_date" maxlength="200" value="<?php echo $order['order_date']; ?>">
    <br/>
    <br/>
    <button type="submit">Actualizar</button>
</form>

<!-- Enlace para volver a la lista de pedidos -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>