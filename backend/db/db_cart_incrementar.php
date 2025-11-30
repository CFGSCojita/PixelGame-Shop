<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']); // Obtenemos el cart_id
    
    // Realizamos una consulta para incrementar la cantidad en +1
    $sql = "UPDATE 006_cart SET quantity = quantity + 1 WHERE cart_id = '$cart_id'";
    
    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_query($conn, $sql)) {
        
        // Actualizamos el contador del carrito
        $user_id = $_SESSION['user_id'];
        $cantidad_sql = "SELECT SUM(quantity) as total FROM 006_cart WHERE user_id = '$user_id'";
        $cantidad_resultado = mysqli_query($conn, $cantidad_sql);
        $fila_count = mysqli_fetch_assoc($cantidad_resultado);
        $_SESSION['cart_count'] = $fila_count['total'] ? $fila_count['total'] : 0;
        
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true, 'cart_count' => $_SESSION['cart_count']]); // Devolvemos una respuesta JSON con el nuevo contador del carrito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn);
    exit();
?>