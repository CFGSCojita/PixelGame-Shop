
<?php
    // Iniciamos sesión
    session_start();
    
    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos.

    // Obtenemos el cart_id
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    
    // Realizamos una consulta para eliminar el producto del carrito
    $sql = "DELETE FROM 006_cart WHERE cart_id = '$cart_id'";
    
    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha eliminado el producto del carrito.";
        
        // Actualizamos el contador del carrito
        $user_id = $_SESSION['user_id']; // Obtenemos el ID del usuario desde la sesión.
        $cantidad_sql = "SELECT SUM(quantity) as total FROM 006_cart WHERE user_id = '$user_id'"; // Realizamos otra consulta para obtener el total de artículos en el carrito.
        $cantidad_resultado = mysqli_query($conn, $cantidad_sql); // Ejecutamos la consulta.
        $fila_count = mysqli_fetch_assoc($cantidad_resultado); // Obtenemos el resultado.
        $_SESSION['cart_count'] = $fila_count['total'] ? $fila_count['total'] : 0; // Actualizamos el contador del carrito en la sesión.
    } else {
        echo "No se ha podido eliminar: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
    
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>