
<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostrar los datos recibidos por el POST.

    // Obtenemos y limpiamos el ID del pedido recibido por el POST.
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']); 

    // Declaramos la consulta SQL para eliminar el pedido con el ID proporcionado.
    $sql = "DELETE FROM 006_orders 
            WHERE order_id = '$order_id'"; 

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha eliminado el pedido correctamente.";
    } else {
        echo "No se ha podido eliminar el pedido por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>