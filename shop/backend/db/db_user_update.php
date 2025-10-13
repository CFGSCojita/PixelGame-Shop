
<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    print_r($_POST); // Mostramos los datos recibidos por el POST.

    // Recogemos los datos del formulario de actualización y los escapamos para evitar inyecciones SQL.
    $user_id = $_POST['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Preparamos la consulta SQL para actualizar el usuario con los nuevos datos.
    $sql = "UPDATE 006_users 
            SET name = '$name', 
                email = '$email', 
                address = '$address', 
                phone = '$phone'
            WHERE user_id = $user_id";

    // Estructura de control 'if'.
    // Si la consulta se ejecuta correctamente, mostramos un mensaje de éxito. En caso contrario, también lo indicamos.
    if (mysqli_query($conn, $sql)) {
        echo "> Se ha actualizado el usuario.";
    } else {
        echo "No se ha podido actualizar el usuario por algún error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>