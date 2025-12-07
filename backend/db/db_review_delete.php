<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Obtenemos el user_id desde la sesión para verificar permisos.
    $user_id = $_SESSION['user_id'];
    
    // Obtenemos y limpiamos el review_id recibido por el POST.
    $review_id = mysqli_real_escape_string($conn, $_POST['review_id']);

    // Preparamos la consulta SQL para eliminar la review.
    // Añadimos WHERE user_id para asegurar que solo el propietario pueda eliminar su review.
    $sql = "DELETE FROM 006_reviews 
            WHERE review_id = '$review_id' AND user_id = '$user_id'";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha eliminado la review correctamente.";
    } else {
        echo "No se ha podido eliminar la review por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>