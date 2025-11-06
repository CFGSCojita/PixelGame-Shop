<?php

// Preparamos la consulta SQL para obtener todos los videojuegos.
$sql = "SELECT 
            v.videogame_id, 
            v.title, 
            v.description, 
            v.price, 
            c.name AS category_name,
            p.name AS platform_name
        FROM 006_videogames AS v
        LEFT JOIN 006_categories AS c ON v.category_id = c.category_id
        LEFT JOIN 006_platforms AS p ON v.platform_id = p.platform_id
        ORDER BY v.videogame_id ASC";
        
$result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

$videogames = []; // Inicializamos un array.

if ($result) {
    // Obtenemos todos los registros como un array asociativo.
    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    mysqli_free_result($result); // Liberamos el resultado de la consulta.
}

// La variable $videogames ahora contiene los datos y está disponible en videogames.php.
// NO cerramos la conexión $conn aquí.
?>