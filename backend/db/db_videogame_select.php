<?php

    // Preparamos la consulta SQL para obtener SOLO los videojuegos propios (supplier_id = 1).
    // El contador de reviews depende del rol:
    // - ADMIN: cuenta TODAS las reviews (validadas y no validadas)
    // - CUSTOMER: cuenta solo las reviews validadas

    if ($_SESSION['role'] === 'admin') {
        // Admin ve el total de reviews (para poder moderar):
        $sql = "SELECT 
                    v.videogame_id, 
                    v.title, 
                    v.description, 
                    v.price,
                    v.image_path, 
                    c.name AS category_name,
                    p.name AS platform_name,
                    COUNT(r.review_id) AS review_count
                FROM 006_videogames AS v
                LEFT JOIN 006_categories AS c ON v.category_id = c.category_id
                LEFT JOIN 006_platforms AS p ON v.platform_id = p.platform_id
                LEFT JOIN 006_reviews AS r ON v.videogame_id = r.videogame_id
                WHERE v.supplier_id = 1
                GROUP BY v.videogame_id
                ORDER BY v.videogame_id ASC";
    } else {
        // Customer solo ve reviews validadas:
        $sql = "SELECT 
                    v.videogame_id, 
                    v.title, 
                    v.description, 
                    v.price,
                    v.image_path, 
                    c.name AS category_name,
                    p.name AS platform_name,
                    COUNT(CASE WHEN r.validated = 1 THEN 1 END) AS review_count
                FROM 006_videogames AS v
                LEFT JOIN 006_categories AS c ON v.category_id = c.category_id
                LEFT JOIN 006_platforms AS p ON v.platform_id = p.platform_id
                LEFT JOIN 006_reviews AS r ON v.videogame_id = r.videogame_id
                WHERE v.supplier_id = 1
                GROUP BY v.videogame_id
                ORDER BY v.videogame_id ASC";
    }
            
    $result = mysqli_execute_query($conn, $sql, []); // Ejecutamos la consulta.

    $videogames = []; // Inicializamos un array.

    if ($result) {
        // Obtenemos todos los registros como un array asociativo.
        $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result); // Liberamos el resultado de la consulta.
    }

    // La variable $videogames ahora contiene solo los productos propios y está disponible en videogames.php.
    // NO cerramos la conexión $conn aquí.
?>