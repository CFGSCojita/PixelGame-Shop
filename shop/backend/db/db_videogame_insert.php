
<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Creamos una variable para cada campo del formulario y limpiamos los valores recibidos por el POST para evitar inyecciones SQL.
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Preparamos la consulta SQL para insertar un nuevo videojuego en la base de datos.
    $sql = "INSERT INTO 006_videogames (title, description, release_date, price, stock) 
            VALUES ('$title', '$description', '$release_date', '$price', '$stock')";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha añadido el videojuego a la base de datos.";
    } else {
        echo "No se ha podido añadir el videojuego por algún error.";
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>