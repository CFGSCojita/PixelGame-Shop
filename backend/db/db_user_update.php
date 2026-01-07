<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Recogemos los datos del formulario de actualización y los escapamos para evitar inyecciones SQL.
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Preparamos la consulta SQL para actualizar el usuario con los nuevos datos.
    $sql = "UPDATE 006_users 
            SET name = ?, 
                email = ?, 
                address = ?, 
                phone = ?
            WHERE user_id = ?";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, [$name, $email, $address, $phone, $user_id])) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>