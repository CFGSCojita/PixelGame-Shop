<?php

    // Connect to database
    $conn = mysqli_connect('localhost', 'root', '', 'shop');
    
    // Check connection
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
        exit();
    }

?>