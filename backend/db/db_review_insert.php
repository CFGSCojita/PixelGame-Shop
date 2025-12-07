<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Obtenemos el user_id desde la sesión.
    $user_id = $_SESSION['user_id'];
    
    // Recogemos los datos del formulario y los escapamos para evitar inyecciones SQL.
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $videogame_id = mysqli_real_escape_string($conn, $_POST['videogame_id']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Preparamos la consulta SQL para insertar la review en la base de datos.
    $sql = "INSERT INTO 006_reviews (user_id, videogame_id, order_id, rating, comment) 
            VALUES ('$user_id', '$videogame_id', '$order_id', '$rating', '$comment')";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha añadido la review correctamente.";
    } else {
        echo "No se ha podido añadir la review por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>