<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Recogemos los datos del formulario de actualización y los escapamos para evitar inyecciones SQL.
    $videogame_id = $_POST['videogame_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = $_POST['category_id'];
    $platform_id = $_POST['platform_id'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Preparamos la consulta SQL para actualizar el videojuego con los nuevos datos.
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