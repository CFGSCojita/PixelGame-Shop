<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Obtenemos el user_id desde la sesión para verificar permisos.
    $user_id = $_SESSION['user_id'];
    
    // Recogemos los datos del formulario y los escapamos para evitar inyecciones SQL.
    $review_id = mysqli_real_escape_string($conn, $_POST['review_id']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Preparamos la consulta SQL para actualizar la review.
    // Añadimos WHERE user_id para asegurar que solo el propietario pueda editar su review.
    $sql = "UPDATE 006_reviews 
            SET rating = '$rating', 
                comment = '$comment'
            WHERE review_id = '$review_id' AND user_id = '$user_id'";

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