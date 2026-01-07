<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Recogemos y escapamos todos los campos necesarios para la actualización.
    $order_id = $_POST['order_id']; 
    $user_id = $_POST['user_id'];
    $videogame_id = $_POST['videogame_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $total = $_POST['total'];
    $order_date = $_POST['order_date']; 

    // Preparamos la consulta SQL para actualizar el pedido.
    $sql = "UPDATE 006_orders 
            SET user_id = ?, 
                videogame_id = ?, 
                quantity = ?, 
                unit_price = ?, 
                total = ?,
                order_date = ?
            WHERE order_id = ?"; // El WHERE usa el order_id oculto del formulario

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito.
    if (mysqli_execute_query($conn, $sql, [$user_id, $videogame_id, $quantity, $unit_price, $total, $order_date, $order_id])) {
        echo "> Se ha actualizado el pedido con ID: " . htmlspecialchars($order_id) . ".";
    } else {
        echo "No se ha podido actualizar el pedido por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');

?>