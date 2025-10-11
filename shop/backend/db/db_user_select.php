<?php

    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');

    // Preparamos la consulta SQL para seleccionar los usuarios en la base de datos.
    $sql = "SELECT user_id, name, email, address, phone FROM users ORDER BY user_id DESC";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta y almacenamos el resultado en una variable.

    // Estructura de control 'if'.
    // Si hay un resultado, obtenemos los registros y los mostramos. En caso contrario, mostramos un mensaje de error.
    if ($result) {
        
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtenemos todos los registros como un array asociativo.

        mysqli_free_result($result); // Liberamos el resultado de la consulta.
        
        echo "<h2>Listado Simple de Usuarios</h2>"; 
        
        // Si hay usuarios, los mostramos. Si no, indicamos que no se encontraron.
        if (count($users) > 0) {
            foreach ($users as $user) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                echo "<h3>ID: " . htmlspecialchars($user['user_id']) . " - " . htmlspecialchars($user['name']) . "</h3>";
                echo "<p><strong>Correo Electrónico:</strong> " . htmlspecialchars($user['email']) . "</p>";
                echo "<p><strong>Dirección:</strong> " . htmlspecialchars($user['address']) . "</p>";
                echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($user['phone']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron usuarios en la base de datos.</p>";
        }

    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerramos la conexión con la base de datos.

    // Llamada al footer a través del directorio root.
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>