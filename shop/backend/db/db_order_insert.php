
<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Recogemos los IDs que deben ser proporcionados por el formulario.
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']); 
    $videogame_id = mysqli_real_escape_string($conn, $_POST['videogame_id']);
    
    // Recogemos el resto de los campos del formulario.
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']); 

    // Preparamos la consulta SQL para insertar un nuevo pedido en la base de datos.
    // La consulta ahora usa los IDs recibidos del formulario.
    $sql = "INSERT INTO 006_orders (user_id, videogame_id, quantity, unit_price, total, order_date) 
            VALUES ('$user_id', '$videogame_id', '$quantity', '$unit_price', '$total', '$order_date')";

    // Estructura de control 'if'.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha añadido el pedido a la base de datos.";
    } else {
        echo "No se ha podido añadir el pedido por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    require($root_DIR . '/student006/shop/backend/php/footer.php');

?>