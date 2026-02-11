<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/config/email_config.php'); // Incluimos la configuración de email
    require($root_DIR . '/student006/shop/backend/php/header.php');

    $user_id = $_SESSION['user_id']; // Obtenemos el ID del usuario desde la sesión.
    
    // Obtenemos los datos del usuario (dirección, email y nombre) para el pedido y el email.
    $sql_user = "SELECT address, email, name FROM 006_users WHERE user_id = ?";
    $result_user = mysqli_execute_query($conn, $sql_user, [$user_id]);
    $user_data = mysqli_fetch_assoc($result_user);
    $user_address = $user_data['address'] ?? ''; // Si no tiene dirección, dejamos vacío
    $user_email = $user_data['email']; // Email del usuario para enviar la confirmación
    $user_name = $user_data['name']; // Nombre del usuario para personalizar el email
    
    // Obtenemos todos los productos del carrito del usuario.
    $sql_carrito = "SELECT 
                        c.videogame_id,
                        c.quantity,
                        v.price,
                        v.title
                    FROM 006_cart c
                    JOIN 006_videogames v ON c.videogame_id = v.videogame_id
                    WHERE c.user_id = ?";
    
    $result_carrito = mysqli_execute_query($conn, $sql_carrito, [$user_id]); // Ejecutamos la consulta.
    
    $pedidos_exitosos = 0;
    $datos_pedidos = []; // Array para almacenar los datos de los pedidos para el email
    $total_general = 0; // Variable para calcular el total de todos los pedidos
    
    // Por cada producto en el carrito, creamos un pedido.
    while ($item = mysqli_fetch_assoc($result_carrito)) {
        $videogame_id = $item['videogame_id'];
        $quantity = $item['quantity'];
        $unit_price = $item['price'];
        $total = $unit_price * $quantity; // Calculamos el total de este producto
        $title = $item['title'];
        
        // INSERT del pedido con la dirección del usuario
        $sql_insert = "INSERT INTO 006_orders (user_id, videogame_id, quantity, unit_price, total, order_address, order_date) 
                       VALUES (?, ?, ?, ?, ?, ?, NOW())";
        
        // Estructura de control 'if'.
        // Si la consulta se ejecuta correctamente, guardamos los datos para el email.
        if (mysqli_execute_query($conn, $sql_insert, [$user_id, $videogame_id, $quantity, $unit_price, $total, $user_address])) {
            $pedidos_exitosos++;
            
            // Guardamos los datos del pedido para el email
            // Formateamos los precios a 2 decimales para que se vean correctamente en el email
            $datos_pedidos[] = [
                'titulo' => $title,
                'cantidad' => $quantity,
                'precio_unitario' => number_format($unit_price, 2),
                'subtotal' => number_format($total, 2)
            ];
            
            $total_general += $total; // Sumamos al total general
        }
    }
    
    // Estructura de control 'if'.
    // Si se insertaron pedidos, limpiamos el carrito y enviamos el email.
    if ($pedidos_exitosos > 0) {
        // Limpiamos el carrito del usuario
        $sql_limpiar = "DELETE FROM 006_cart WHERE user_id = ?";
        mysqli_execute_query($conn, $sql_limpiar, [$user_id]);
        
        // Actualizamos el contador del carrito en la sesión.
        $_SESSION['cart_count'] = 0;
        
        // Enviamos el email de confirmación al usuario
        // Le pasamos: email del usuario, nombre, array con los productos y el total formateado
        $email_enviado = enviar_email_pedido(
            $user_email,  // Email del usuario (obtenido de la BD)
            $user_name,   // Nombre del usuario (obtenido de la BD)
            $datos_pedidos, // Array con los productos comprados
            number_format($total_general, 2) // Total formateado a 2 decimales
        );
        
        echo "<h2>Pedido realizado con éxito</h2>";
        echo "<p>Se han creado $pedidos_exitosos pedidos.</p>";
        
        // Mostramos mensaje sobre el email
        // Estructura de control 'if-else'.
        // Comprobamos si el email se envió correctamente.
        if ($email_enviado) {
            echo "<p style='color: #00CCFF;'>✓ Se ha enviado un email de confirmación a: $user_email</p>";
        } else {
            echo "<p style='color: #FF3366;'>⚠ El pedido se realizó correctamente, pero hubo un problema al enviar el email de confirmación.</p>";
        }
        
        echo "<a href='/student006/shop/backend/php/orders.php'>Ver mis pedidos</a>";
    } else {
        echo "<h2>Error al procesar el pedido</h2>";
        echo "<p>No se pudo completar la operación.</p>";
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>