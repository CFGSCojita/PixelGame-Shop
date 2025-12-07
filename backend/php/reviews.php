<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    
    // Verificamos que se haya recibido el videogame_id.
    if (!isset($_POST['videogame_id'])) {
        echo "<p class='error-message'>Error: No se ha especificado el videojuego.</p>";
        echo "<a href='/student006/shop/backend/php/videogames.php' class='enlace-volver'>← Volver a Videojuegos</a>";
        require($root_DIR . '/student006/shop/backend/php/footer.php');
        exit();
    }
    
    $videogame_id = $_POST['videogame_id'];
    
    // Obtenemos el título del videojuego.
    $sql_game = "SELECT title FROM 006_videogames WHERE videogame_id = '$videogame_id'";
    $result_game = mysqli_query($conn, $sql_game);
    $game = mysqli_fetch_assoc($result_game);
    
    // Obtenemos todas las reviews de este videojuego.
    $sql_reviews = "SELECT 
                        r.review_id,
                        r.rating,
                        r.comment,
                        r.review_date,
                        u.name AS user_name
                    FROM 006_reviews r
                    JOIN 006_users u ON r.user_id = u.user_id
                    WHERE r.videogame_id = '$videogame_id'
                    ORDER BY r.review_date DESC";
    
    $result_reviews = mysqli_query($conn, $sql_reviews);
    $reviews = mysqli_fetch_all($result_reviews, MYSQLI_ASSOC);
?>

<!-- CSS específico de reviews -->
<link rel="stylesheet" href="/student006/shop/css/reviews-php.css">

<h1>Reviews de: <?php echo htmlspecialchars($game['title']); ?></h1>

<hr>

<!-- Si hay reviews, las mostramos -->
<?php if (!empty($reviews)): ?>
    <?php foreach ($reviews as $review): ?>
        
        <div class="review-entry">
            
            <!-- Usuario y puntuación -->
            <div class="review-header">
                <strong class="review-user-name">👤 <?php echo htmlspecialchars($review['user_name']); ?></strong>
                <span class="review-rating">
                    <?php 
                        // Mostramos estrellas según el rating.
                        for ($i = 0; $i < $review['rating']; $i++) {
                            echo "⭐";
                        }
                    ?>
                </span>
            </div>
            
            <!-- Comentario -->
            <?php if (!empty($review['comment'])): ?>
                <p class="review-comment">
                    <?php echo nl2br(htmlspecialchars($review['comment'])); ?>
                </p>
            <?php endif; ?>
            
            <!-- Fecha -->
            <p class="review-date">
                📅 <?php echo date('d/m/Y H:i', strtotime($review['review_date'])); ?>
            </p>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p>No hay reviews para este videojuego todavía.</p>
<?php endif; ?>

<br/>
<a href="/student006/shop/backend/php/videogames.php" class="enlace-volver">← Volver a Videojuegos</a>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>