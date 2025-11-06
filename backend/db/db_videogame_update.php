<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Recogemos los datos del formulario de actualización y los escapamos para evitar inyecciones SQL.
    $videogame_id = $_POST['videogame_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = $_POST['category_id'];
    $platform_id = $_POST['platform_id'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Preparamos la consulta SQL para actualizar el videojuego con los nuevos datos, incluyendo categoría y plataforma.
    $sql = "UPDATE 006_videogames 
            SET category_id = '$category_id',
                platform_id = '$platform_id',
                title = '$title', 
                description = '$description', 
                release_date = '$release_date', 
                price = '$price', 
                stock = '$stock'
            WHERE videogame_id = $videogame_id";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha actualizado el videojuego.";
    } else {
        echo "No se ha podido actualizar el videojuego por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');

?>