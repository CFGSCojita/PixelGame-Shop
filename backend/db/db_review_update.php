<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

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
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha actualizado la review correctamente.";
    } else {
        echo "No se ha podido actualizar la review por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>