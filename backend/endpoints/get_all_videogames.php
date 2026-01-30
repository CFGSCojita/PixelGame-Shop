<?php
    // Configuramos los encabezados HTTP:
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");

    // Incluimos la conexión a la base de datos:
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Creamos una consulta SQL para obtener todos los videojuegos:
    $sql = "SELECT 
                v.videogame_id,
                v.title,
                v.description,
                v.price,
                v.stock,
                v.release_date,
                v.image_path,
                c.name as category_name,
                p.name as platform_name
            FROM 006_videogames v
            LEFT JOIN 006_categories c ON v.category_id = c.category_id
            LEFT JOIN 006_platforms p ON v.platform_id = p.platform_id
            WHERE v.stock > 0
            ORDER BY v.title ASC";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    // Estructura de control 'if'.
    // Si hay error en la consulta, devolvemos el error en formato JSON.
    if (!$result) {
        echo json_encode([
            'success' => false,
            'error' => mysqli_error($conn)
        ]);
        mysqli_close($conn);
        exit;
    }

    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtenemos todos los resultados como array asociativo.
    
    // Devolvemos la respuesta JSON:
    echo json_encode([
        'success' => true,
        'videogames' => $videogames,
        'total' => count($videogames)
    ]);

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
?>