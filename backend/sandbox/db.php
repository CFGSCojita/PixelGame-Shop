
<?php 

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $text = $_GET["text"];

    $sql = "SELECT title FROM 006_videogames
            WHERE title LIKE '%$text%'";

    $result = mysqli_query($conn, $sql);

    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $videogames_json = json_encode($videogames);

    echo $videogames_json;

    mysqli_close($conn);

?>