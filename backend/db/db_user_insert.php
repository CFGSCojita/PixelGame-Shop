<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Creamos una variable para cada campo del formulario y limpiamos los valores recibidos por el POST para evitar inyecciones SQL.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    
    // Hasheamos la contraseña antes de guardarla.
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Preparamos la consulta SQL para insertar un nuevo usuario en la base de datos.
    $sql = "INSERT INTO 006_users (name, email, password_hash, address, phone) 
            VALUES (?, ?, ?, ?, ?)";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_execute_query($conn, $sql, [$name, $email, $password_hash, $address, $phone])) {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Enviamos datos en formato JSON al navegador.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON con el error.
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.
    exit(); // Terminamos el script.
?>