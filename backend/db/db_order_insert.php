<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    $user_id = $_SESSION['user_id']; // Obtenemos el ID del usuario desde la sesión.
    
    // Obtenemos todos los productos del carrito del usuario.
    $sql_carrito = "SELECT 
                        c.videogame_id,
                        c.quantity,
                        v.price
                    FROM 006_cart c
                    JOIN 006_videogames v ON c.videogame_id = v.videogame_id
                    WHERE c.user_id = ?";
    
    $result_carrito = mysqli_execute_query($conn, $sql_carrito, [$user_id]); // Ejecutamos la consulta.
    
    $pedidos_exitosos = 0;
    
    // Por cada producto en el carrito, creamos un pedido.
    while ($item = mysqli_fetch_assoc($result_carrito)) {
        $videogame_id = $item['videogame_id'];
        $quantity = $item['quantity'];
        $unit_price = $item['price'];
        $total = $unit_price * $quantity;
        
        // INSERT del pedido.
        $sql_insert = "INSERT INTO 006_orders (user_id, videogame_id, quantity, unit_price, total, order_date) 
                       VALUES (?, ?, ?, ?, ?, NOW())";
        
        if (mysqli_execute_query($conn, $sql_insert, [$user_id, $videogame_id, $quantity, $unit_price, $total])) {
            $pedidos_exitosos++;
        }
    }
    
    // Estructura de control 'if'.
    // Si se insertaron pedidos, limpiamos el carrito.
    if ($pedidos_exitosos > 0) {
        $sql_limpiar = "DELETE FROM 006_cart WHERE user_id = ?";
        mysqli_execute_query($conn, $sql_limpiar, [$user_id]);
        
        // Actualizamos el contador del carrito en la sesión.
        $_SESSION['cart_count'] = 0;
        
        echo "<h2>Pedido realizado con éxito</h2>";
        echo "<p>Se han creado $pedidos_exitosos pedidos.</p>";
        echo "<a href='/student006/shop/backend/php/orders.php'>Ver mis pedidos</a>";
    } else {
        echo "<h2>Error al procesar el pedido</h2>";
        echo "<p>No se pudo completar la operación.</p>";
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>