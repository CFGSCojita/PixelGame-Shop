<?php

    // -- LOCALHOST --
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = '006_pixelgame_shop';

    // -- REMOTE SERVER --
    // $hostname = 'remotehost.es';
    // $username = 'dwess1234';
    // $password = 'Usertest1234.';
    // $db = 'dwesdatabase';

    // Nos conectamos a la base de datos con las credenciales.
    $conn = mysqli_connect($hostname, $username, $password, $db);
    
    // Verificamos la conexión.
    if (!$conn) {
        echo 'Error de conexión: ' . mysqli_connect_error();
        exit();
    }

    // Establecemos el charset UTF-8 para evitar problemas con caracteres especiales.
    mysqli_set_charset($conn, 'utf8');

?>