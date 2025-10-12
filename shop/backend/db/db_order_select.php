
<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    // Preparamos la consulta SQL para seleccionar los pedidos.
    // Usamos JOIN para obtener el nombre del usuario y el título del videojuego
    // en lugar de solo sus IDs.
    $sql = "SELECT 
                o.order_id, 
                o.quantity, 
                o.unit_price, 
                o.total, 
                o.order_date,
                u.name AS user_name,      
                v.title AS videogame_title
            FROM 
                orders o
            JOIN 
                users u ON o.user_id = u.user_id
            JOIN 
                videogames v ON o.videogame_id = v.videogame_id
            ORDER BY 
                o.order_id DESC";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    // Estructura de control 'if'.
    if ($result) {
        
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtenemos todos los registros como un array asociativo.

        mysqli_free_result($result); // Liberamos el resultado de la consulta.
        
        echo "<h2>Listado Detallado de Pedidos</h2>"; 
        
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                echo "<div style='border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; background-color: #f9f9f9;'>";
                echo "<h3>Pedido ID: " . htmlspecialchars($order['order_id']) . "</h3>";
                echo "<p><strong>Usuario:</strong> " . htmlspecialchars($order['user_name']) . "</p>";
                echo "<p><strong>Videojuego:</strong> " . htmlspecialchars($order['videogame_title']) . "</p>";
                echo "<p><strong>Fecha:</strong> " . htmlspecialchars($order['order_date']) . "</p>";
                echo "<p><strong>Cantidad:</strong> " . htmlspecialchars($order['quantity']) . "</p>";
                echo "<p><strong>Precio Unitario:</strong> " . htmlspecialchars($order['unit_price']) . "€</p>";
                echo "<p><strong>TOTAL:</strong> <span style='font-size: 1.2em; color: green;'><strong>" . htmlspecialchars($order['total']) . "€</strong></span></p>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron pedidos en la base de datos.</p>";
        }

    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>