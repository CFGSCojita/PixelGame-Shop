<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $videogame_id = $_POST['videogame_id']; // Obtenemos el ID del videojuego.
    $user_id = $_SESSION['user_id']; // Obtenemos el ID del usuario desde la sesión.

    // Preparamos la consulta SQL para verificar si el videojuego ya está en el carrito del usuario.
    $sql_select = "SELECT cart_id, quantity FROM 006_cart
            WHERE user_id = ? AND videogame_id = ?"; 

    $result = mysqli_execute_query($conn, $sql_select, [$user_id, $videogame_id]); // Ejecutamos la consulta.

    // Estructura de control 'if'.
    // Si el videojuego ya está en el carrito, actualizamos la cantidad.
    if (mysqli_num_rows($result) > 0) {
        $fila = mysqli_fetch_assoc($result); // Obtenemos la fila resultante.
        $nueva_cantidad = $fila['quantity'] + 1; // Incrementamos la cantidad.
        $cart_id = $fila['cart_id']; // Obtenemos el ID del carrito.
        
        $sql = "UPDATE 006_cart SET quantity = ? WHERE cart_id = ?"; // Preparamos la consulta SQL para actualizar la cantidad.
        $params = [$nueva_cantidad, $cart_id];
    } else {
        // En caso contrario, insertamos un nuevo registro en el carrito.
        // Esto se hace para añadir el videojuego al carrito.
        $sql = "INSERT INTO 006_cart (user_id, videogame_id, quantity, date_added) 
                VALUES (?, ?, 1, NOW())";
        $params = [$user_id, $videogame_id];
    }
    
    // Estructura de control 'if'.
    // Ponemos la consulta SQL en ejecución para añadir el videojuego al carrito.
    if (mysqli_execute_query($conn, $sql, $params)) {
        
        $cantidad_sql = "SELECT SUM(quantity) as total FROM 006_cart WHERE user_id = ?"; // Realizamos una consulta para contar el total de artículos en el carrito.
        $cantidad_resultado = mysqli_execute_query($conn, $cantidad_sql, [$user_id]); // Ejecutamos la consulta.
        $fila_count = mysqli_fetch_assoc($cantidad_resultado); // Obtenemos el resultado.
        $_SESSION['cart_count'] = $fila_count['total']; // Actualizamos el contador del carrito en la sesión.
    } else {
        echo "No se ha podido añadir al carrito: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión a la base de datos.

    header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
    echo json_encode(['success' => true, 'cart_count' => $_SESSION['cart_count']]); // Devolvemos una respuesta JSON con el nuevo contador del carrito.
    exit(); // Terminamos el script.
?>