<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos el user_id desde la sesión.
    $user_id = $_SESSION['user_id'];
    
    // Recogemos los datos del formulario y los escapamos para evitar inyecciones SQL.
    $order_id = $_POST['order_id'];
    $videogame_id = $_POST['videogame_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Preparamos la consulta SQL para insertar la review en la base de datos.
    $sql = "INSERT INTO 006_reviews (user_id, videogame_id, order_id, rating, comment) 
            VALUES (?, ?, ?, ?, ?)";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, [$user_id, $videogame_id, $order_id, $rating, $comment])) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>