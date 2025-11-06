<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Recogemos y escapamos todos los campos necesarios para la actualización.
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']); 
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $videogame_id = mysqli_real_escape_string($conn, $_POST['videogame_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']); 

    // Preparamos la consulta SQL para actualizar el pedido.
    $sql = "UPDATE 006_orders 
            SET user_id = '$user_id', 
                videogame_id = '$videogame_id', 
                quantity = '$quantity', 
                unit_price = '$unit_price', 
                total = '$total',
                order_date = '$order_date'
            WHERE order_id = $order_id"; // El WHERE usa el order_id oculto del formulario

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha actualizado el pedido con ID: " . htmlspecialchars($order_id) . ".";
    } else {
        echo "No se ha podido actualizar el pedido por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');

?>