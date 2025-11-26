<?php

// Estructura de control 'if'.
// Si el usuario es 'customer', obtenemos SOLO sus pedidos.
// En caso contrario, obtenemos todos los pedidos (es decir, solo siendo admin).
if ($_SESSION['role'] === 'customer') {
    $user_id = $_SESSION['user_id'];
    
    // Realizamos una consulta SQL con JOINs para obtener los pedidos del usuario específico.
    $sql = "SELECT 
                o.order_id, 
                o.quantity, 
                o.unit_price, 
                o.total, 
                o.order_date,
                u.name AS user_name,      
                v.title AS videogame_title
            FROM 
                006_orders o
            JOIN 
                006_users u ON o.user_id = u.user_id
            JOIN 
                006_videogames v ON o.videogame_id = v.videogame_id
            WHERE 
                o.user_id = '$user_id'
            ORDER BY 
                o.order_id DESC";
} else {
    // Realizamos una consulta SQL con JOINs para obtener todos los pedidos.
    $sql = "SELECT 
                o.order_id, 
                o.quantity, 
                o.unit_price, 
                o.total, 
                o.order_date,
                u.name AS user_name,      
                v.title AS videogame_title
            FROM 
                006_orders o
            JOIN 
                006_users u ON o.user_id = u.user_id
            JOIN 
                006_videogames v ON o.videogame_id = v.videogame_id
            ORDER BY 
                o.order_id DESC";
}
        
$result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

$orders = []; // Inicializamos un array.

if ($result) {
    // Obtenemos todos los registros como un array asociativo.
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    mysqli_free_result($result); // Liberamos el resultado de la consulta.
}

// La variable $orders ahora contiene los datos y está disponible en orders.php.
// NO cerramos la conexión $conn aquí.
?>