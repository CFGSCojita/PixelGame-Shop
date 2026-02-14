<?php
    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    session_start();

    // Obtenemos el ID del pedido recibido por POST.
    $order_id = $_POST['order_id'];

    // Consulta SQL para eliminar el pedido con el ID proporcionado.
    $sql = "DELETE FROM 006_orders WHERE order_id = ?";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, devolvemos éxito. En caso contrario, devolvemos el error.
    if (mysqli_execute_query($conn, $sql, [$order_id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }

    mysqli_close($conn);
    header('Content-Type: application/json');
    exit();
?>