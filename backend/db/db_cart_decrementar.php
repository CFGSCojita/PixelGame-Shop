<?php
    // Iniciamos la sesión.
    session_start();

    // Conexión a la base de datos.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $cart_id = $_POST['cart_id']; // Obtenemos con POST el ID del carrito a modificar.

    // Realizamos una consulta para decrementar la cantidad del producto en el carrito, pero solo si la cantidad es mayor a 1:
    $sql = "UPDATE 006_cart SET quantity = quantity - 1 
            WHERE cart_id = ? AND quantity > 1";
    
    mysqli_execute_query($conn, $sql, [$cart_id]); // Ejecutamos la consulta con el ID del carrito como parámetro.

    // Estructura de control 'if'.
    // Si no se ha actualizado ningún registro (es decir, si la cantidad ya era 1), eliminamos el producto del carrito:
    if (mysqli_affected_rows($conn) === 0) {
        mysqli_execute_query($conn, "DELETE FROM 006_cart WHERE cart_id = ?", [$cart_id]);
    }

    $user_id = $_SESSION['user_id']; // Actualizamos el contador de productos en el carrito para el usuario actual.

    $res = mysqli_execute_query($conn, "SELECT SUM(quantity) as total FROM 006_cart WHERE user_id = ?", [$user_id]); // Obtenemos la suma total de cantidades de productos en el carrito del usuario.

    $fila = mysqli_fetch_assoc($res); // Guardamos el total en la sesión, o 0 si no hay productos en el carrito.

    $_SESSION['cart_count'] = $fila['total'] ?? 0; // Devolvemos una respuesta JSON con el nuevo contador de productos en el carrito.

    header('Content-Type: application/json'); // Establecemos el tipo de contenido a JSON para que el frontend pueda procesar la respuesta correctamente.
    echo json_encode(['success' => true, 'cart_count' => $_SESSION['cart_count']]); // Devolvemos una respuesta JSON con el nuevo contador de productos en el carrito.

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
    exit();
?>