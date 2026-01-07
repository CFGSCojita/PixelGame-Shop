<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $videogame_id = $_POST['videogame_id']; // Limpiamos el valor recibido por el POST.

    // Declaramos la consulta SQL para eliminar el videojuego con el ID proporcionado.
    $sql = "DELETE FROM 006_videogames 
            WHERE videogame_id = ?";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, [$videogame_id])) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>