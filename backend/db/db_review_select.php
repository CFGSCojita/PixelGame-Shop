<?php

    // Obtenemos las reviews de este videojuego.
    // Si es admin: ve TODAS las reviews (validadas y no validadas)
    // Si NO es admin: solo ve las reviews validadas
    if ($_SESSION['role'] === 'admin') {
        $sql_reviews = "SELECT 
                            r.review_id,
                            r.rating,
                            r.comment,
                            r.review_date,
                            r.validated,
                            u.name AS user_name
                        FROM 006_reviews r
                        JOIN 006_users u ON r.user_id = u.user_id
                        WHERE r.videogame_id = '$videogame_id'
                        ORDER BY r.review_date DESC";
    } else {
        $sql_reviews = "SELECT 
                            r.review_id,
                            r.rating,
                            r.comment,
                            r.review_date,
                            r.validated,
                            u.name AS user_name
                        FROM 006_reviews r
                        JOIN 006_users u ON r.user_id = u.user_id
                        WHERE r.videogame_id = '$videogame_id' 
                        AND r.validated = 1
                        ORDER BY r.review_date DESC";
    }

    $result_reviews = mysqli_query($conn, $sql_reviews); // Ejecutamos la consulta.
    $reviews = mysqli_fetch_all($result_reviews, MYSQLI_ASSOC); // Obtenemos todas las reviews.

    // La variable $reviews ahora contiene los datos y está disponible en reviews.php.
    // NO cerramos la conexión $conn aquí.
?>