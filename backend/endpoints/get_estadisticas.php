<?php
    // Conexión a la base de datos:
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Declaramos un array para almacenar los datos de las estadísticas, que las obtendremos seleccionando las vistas que hay en la base de datos:
    $datos = [
        'por_mes'      => mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM 006_view_orders_by_month"), MYSQLI_ASSOC),
        'por_cliente'  => mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM 006_view_orders_by_customer"), MYSQLI_ASSOC),
        'por_producto' => mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM 006_view_orders_by_product"), MYSQLI_ASSOC),
    ];

    mysqli_close($conn); // Cerramos la conexión a la base de datos.

    header('Content-Type: application/json'); // Indicamos que la respuesta será en formato JSON.
    echo json_encode($datos); // Codificamos el array de datos en formato JSON y lo enviamos como respuesta al cliente.
?>