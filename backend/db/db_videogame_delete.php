<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostrar los datos recibidos por el POST.

    $videogame_id = mysqli_real_escape_string($conn, $_POST['videogame_id']); // Limpiamos el valor recibido por el POST.

    // Declaramos la consulta SQL para eliminar el videojuego con el ID proporcionado.
    $sql = "DELETE FROM 006_videogames 
            WHERE videogame_id = '$videogame_id'";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha eliminado el videojuego correctamente.";
    } else {
        echo "No se ha podido eliminar el videojuego por algún error.";
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>