
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect_localhost.php');
?>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<?php

    print_r($_POST); // Show data

    // Get data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Insert data
    $sql = "INSERT INTO videogames (title, description, release_date, price, stock) 
            VALUES ('$title', '$description', '$release_date', '$price', '$stock')";

    if (mysqli_query($conn, $sql)) {
        echo "> Se ha añadido el videojuego a la base de datos.";
    } else {
        echo "No se ha podido añadir el videojuego por algún error.";
    }

    mysqli_close($conn);

?>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>