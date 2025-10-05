<?php

    // Get data
    $title = $_GET['title'];
    $description = $_GET['description'];
    $release_date = $_GET['release_date'];
    $price = $_GET['price'];
    $stock = $_GET['stock'];

    // Insert data
    $sql = "INSERT INTO videogames VALUES ('$title', '$description', '$release_date', '$price', '$stock')";

?>