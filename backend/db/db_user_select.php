<?php

// Preparamos la consulta SQL para seleccionar los usuarios en la base de datos.
$sql = "SELECT user_id, name, email, address, phone, role 
        FROM 006_users 
        ORDER BY user_id DESC";

$result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

$users = []; // Inicializamos un array.

if ($result) {
    // Obtenemos todos los registros como un array asociativo.
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    mysqli_free_result($result); // Liberamos el resultado de la consulta.
}

// La variable $users ahora contiene los datos y está disponible en users.php.
// NO cerramos la conexión $conn aquí.
?>