<?php
    // Conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Establecemos que la respuesta será JSON
    header('Content-Type: application/json');

    // Recibimos el texto de búsqueda por GET y lo escapamos para evitar inyecciones SQL.
    $texto = isset($_GET["texto"]) ? mysqli_real_escape_string($conn, $_GET["texto"]) : '';

    // Realizamos una consulta SQL para buscar videojuegos cuyo título contenga el texto introducido.
    // Usamos LEFT JOIN para obtener también la categoría y plataforma de cada videojuego.
    $sql = "SELECT 
            v.videogame_id, 
            v.title, 
            v.price,
            v.image_path,
            c.name AS category_name, 
            p.name AS platform_name
        FROM 006_videogames v
        LEFT JOIN 006_categories c ON v.category_id = c.category_id
        LEFT JOIN 006_platforms p ON v.platform_id = p.platform_id
        WHERE v.title LIKE '%$texto%'
        ORDER BY v.title ASC";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    // Estructura de control 'if'.
    // Si hay error en la consulta, devolvemos el error en formato JSON.
    if (!$result) {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }

    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC); // Convertimos los resultados en un array asociativo.

    echo json_encode($videogames); // Devolvemos los datos en formato JSON.

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
?>