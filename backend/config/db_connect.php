<?php

    // Nos conectamos a la base de datos con las credenciales.
    $conn = mysqli_connect('localhost', 'root', '', '006_pixelgame_shop');
    
    // Verificamos la conexión.
    if (!$conn) {
        echo 'Error de conexión: ' . mysqli_connect_error();
        exit();
    }

?>