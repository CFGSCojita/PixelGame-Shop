
<?php

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

?>

<?php

    print_r($_GET); // Show data

    // Get data
    $title = $_GET['title'];
    $description = $_GET['description'];
    $release_date = $_GET['release_date'];
    $price = $_GET['price'];
    $stock = $_GET['stock'];

    // Insert data
    $sql = "INSERT INTO videogames (title, description, release_date, price, stock) 
            VALUES ('$title', '$description', '$release_date', '$price', '$stock')";

?>