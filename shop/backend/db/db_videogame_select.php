<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    // Preparamos la consulta SQL para seleccionar los videojuegos en la base de datos.
    $sql = "SELECT videogame_id, title, description, release_date, price, stock FROM videogames ORDER BY videogame_id DESC";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta y almacenamos el resultado en una variable.

    // Estructura de control 'if'.
    // Si hay un resultado, obtenemos los registros y los mostramos en un formato sencillo. En caso contrario, mostramos un mensaje de error.
    if ($result) {
        
        $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtenemos todos los registros como un array asociativo.

        mysqli_free_result($result); // Liberamos el resultado de la consulta.
        
        echo "<h2>Listado Simple de Videojuegos</h2>"; 
        
        // Si hay videojuegos, los mostramos. Si no, indicamos que no se encontraron.
        if (count($videogames) > 0) {
            foreach ($videogames as $game) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                echo "<h3>ID: " . htmlspecialchars($game['videogame_id']) . " - " . htmlspecialchars($game['title']) . "</h3>";
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($game['description']) . ".</p>";
                echo "<p><strong>Fecha de Lanzamiento:</strong> " . htmlspecialchars($game['release_date']) . "</p>";
                echo "<p><strong>Precio:</strong> $" . htmlspecialchars($game['price']) . "</p>";
                echo "<p><strong>Stock:</strong> " . htmlspecialchars($game['stock']) . " unidades.</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron videojuegos en la base de datos.</p>";
        }

    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>