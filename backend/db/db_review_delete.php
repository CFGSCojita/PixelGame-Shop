<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos el user_id desde la sesión.
    $user_id = $_SESSION['user_id'];
    
    // Obtenemos y limpiamos el review_id recibido por el POST.
    $review_id = $_POST['review_id'];

    // Preparamos la consulta SQL para eliminar la review.
    // Si es ADMIN: puede eliminar cualquier review (sin filtro de user_id)
    // Si es CUSTOMER: solo puede eliminar sus propias reviews
    if ($_SESSION['role'] === 'admin') {
        $sql = "DELETE FROM 006_reviews 
                WHERE review_id = ?";
        $params = [$review_id];
    } else {
        $sql = "DELETE FROM 006_reviews 
                WHERE review_id = ? AND user_id = ?";
        $params = [$review_id, $user_id];
    }

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, $params)) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>