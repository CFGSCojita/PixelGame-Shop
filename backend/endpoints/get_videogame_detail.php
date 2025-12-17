<?php
    // Endpoint para obtener el detalle de un videojuego específico
    // Recibimos el ID por GET y devolvemos todos los datos del videojuego en JSON
    
    // Conexión a la base de datos
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos el ID del videojuego desde la URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Consulta SQL para obtener todos los datos del videojuego
    // Incluimos nombre de categoría y plataforma mediante LEFT JOIN
    $sql = "SELECT 
                v.videogame_id, 
                v.title, 
                v.description,
                v.price,
                v.image_path,
                v.stock,
                c.name AS category_name,
                p.name AS platform_name
            FROM 006_videogames AS v
            LEFT JOIN 006_categories AS c ON v.category_id = c.category_id
            LEFT JOIN 006_platforms AS p ON v.platform_id = p.platform_id
            WHERE v.videogame_id = $id";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta
    $game = mysqli_fetch_assoc($result); // Obtenemos el resultado como array asociativo

    // Devolvemos el resultado en formato JSON
    header('Content-Type: application/json');
    echo json_encode($game);

    mysqli_close($conn); // Cerramos la conexión
?>