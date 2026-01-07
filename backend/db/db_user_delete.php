<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos y limpiamos el ID del usuario recibido por el POST.
    $user_id = $_POST['user_id']; 

    // Declaramos la consulta SQL para eliminar el usuario con el ID proporcionado.
    $sql = "DELETE FROM 006_users 
            WHERE user_id = ?";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, [$user_id])) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>