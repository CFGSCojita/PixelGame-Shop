<?php
    // Conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Consulta SQL: Obtener los 5 videojuegos más vendidos
    // Hacemos JOIN entre orders y videogames para obtener títulos
    // Agrupamos por videojuego y contamos cuántas veces se ha vendido
    $sql = "SELECT 
                v.title,
                COUNT(o.order_id) AS total_ventas
            FROM 006_orders o
            JOIN 006_videogames v ON o.videogame_id = v.videogame_id
            GROUP BY o.videogame_id, v.title
            ORDER BY total_ventas DESC
            LIMIT 5";
    
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.
    
    $datos = []; // Inicializamos array para los datos.
    
    // Estructura de control 'if'.
    // Si la consulta devuelve resultados, los procesamos. Si no, el array $datos quedará vacío.
    if ($result) {
        // Bucle 'while'.
        // Mientras haya registros en el resultado, los vamos añadiendo al array $datos con el formato requerido:
        while ($row = mysqli_fetch_assoc($result)) {
            $datos[] = [
                'title' => $row['title'],
                'ventas' => (int)$row['total_ventas']
            ];
        }
    }
    
    mysqli_close($conn); // Cerramos la conexión.
    
    // Devolvemos los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($datos);
?>