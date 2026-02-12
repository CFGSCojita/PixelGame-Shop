<?php
    // Conexión a la base de datos
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Establecemos que la respuesta será JSON:
    header('Content-Type: application/json');

    // Realizamos una consulta SQL para obtener solo los productos del supplier_id = 2 (Bruno)
    $sql = "SELECT 
                v.videogame_id, 
                v.title, 
                v.price,
                v.stock,
                v.supplier_id
            FROM 006_videogames v
            WHERE v.supplier_id = 2
            ORDER BY v.videogame_id ASC";
    
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    // Si hay error en la consulta, devolvemos el error:
    if (!$result) {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }

    // Convertimos los resultados en un array asociativo:
    $productos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Devolvemos los datos en formato JSON
    echo json_encode($productos);

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
?>