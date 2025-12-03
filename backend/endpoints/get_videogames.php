<?php
    // Conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Recibimos el parámetro de la página de la URL con GET, el operador ternario actúa como un condicional, si 'pagina' existe
    // en la URL, se convierte a entero y se asigna a $pagina, si no existe, se asigna 1 por defecto. 
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $por_pagina = 5; // Definimos cuántos videojuegos queremos mostrar por página.

    // Calculamos cuántos registros nos debemos de saltar para llegar al inicio de la página actual.
    // Si estamos en la página 1, no saltamos nada.
    // Si estamos en la página 2, saltamos los primeros 5 registros para empezar desde el 6º.
    // Si estamos en la página 3, saltamos 10 registros para empezar desde el 11º, y así sucesivamente.
    $offset = ($pagina - 1) * $por_pagina;

    // Realizamos una consulta SQL para obtener los videojuegos con sus categorías y plataformas.
    // Usamos LEFT JOIN para asegurarnos de que se muestren todos los videojuegos, incluso si no tienen categoría o plataforma asignada.
    $sql = "SELECT 
                v.videogame_id, 
                v.title, 
                v.price,
                c.name AS category_name,
                p.name AS platform_name
            FROM 006_videogames AS v
            LEFT JOIN 006_categories AS c ON v.category_id = c.category_id
            LEFT JOIN 006_platforms AS p ON v.platform_id = p.platform_id
            ORDER BY v.videogame_id ASC
            LIMIT $por_pagina OFFSET $offset";
    
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta y obtenemos los resultados.
    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC); // Convertimos los resultados en un array asociativo.

    $sql_total = "SELECT COUNT(*) as total FROM 006_videogames"; // Realizamos una consulta para obtener el total de videojuegos y la guardamos en una nueva variable.
    $result_total = mysqli_query($conn, $sql_total); // Ejecutamos la consulta y la guardamos en una variable para el resultado total.
    $total = mysqli_fetch_assoc($result_total)['total']; // Obtenemos el total de videojuegos desde el resultado.
    $total_paginas = ceil($total / $por_pagina); // Calculamos el total de páginas redondeando hacia arriba.

    // Devolvemos los datos en formato JSON.
    header('Content-Type: application/json'); // Indicamos que la respuesta es de tipo JSON.
    // Creamos un array con los videojuegos, la página actual y el total de páginas, y lo convertimos a JSON.
    echo json_encode([
        'videogames' => $videogames,
        'pagina_actual' => $pagina,
        'total_paginas' => $total_paginas
    ]);

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
?>