
<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    print_r($_POST); // Mostramos los datos recibidos por POST.

    $videogame_id = mysqli_real_escape_string($conn, $_POST['videogame_id']); // Obtenemos el ID del videojuego.
    $user_id = $_SESSION['user_id']; // Obtenemos el ID del usuario desde la sesión.

    // Preparamos la consulta SQL para verificar si el videojuego ya está en el carrito del usuario.
    $sql_select = "SELECT cart_id, quantity FROM 006_cart
            WHERE user_id = '$user_id' AND videogame_id = '$videogame_id'"; 

    $result = mysqli_query($conn, $sql_select); // Ejecutamos la consulta.

    // Pendiente por continuar.

?>