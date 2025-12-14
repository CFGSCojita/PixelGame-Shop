<?php
    // Iniciamos la sesión.
    session_start();

    // Verificamos que sea admin
    if ($_SESSION['role'] !== 'admin') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'No tienes permisos']);
        exit();
    }

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos el review_id recibido por el POST.
    $review_id = mysqli_real_escape_string($conn, $_POST['review_id']);

    // Preparamos la consulta SQL para validar la review (poner validated = 1).
    $sql = "UPDATE 006_reviews 
            SET validated = 1
            WHERE review_id = '$review_id'";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_query($conn, $sql)) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>