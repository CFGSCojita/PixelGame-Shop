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
    
    // Incluimos el archivo que obtiene las reviews.
    include($root_DIR . '/student006/shop/backend/db/db_review_select.php');
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

            <!-- BOTONES ADMIN: Validar o Eliminar review -->
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <div class="admin-actions">
                    
                    <!-- Si NO está validada, mostramos botón de VALIDAR -->
                    <?php if ($review['validated'] == 0): ?>
                        <form method="POST" action="/student006/shop/backend/db/db_review_validate.php">
                            <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($review['review_id']); ?>">
                            <button type="submit" class="btn-validar">
                                ✓ Validar Review
                            </button>
                        </form>
                    <?php else: ?>
                        <!-- Si YA está validada, mostramos un indicador -->
                        <span class="review-validada">✓ Review Validada</span>
                    <?php endif; ?>

                    <!-- Botón ELIMINAR (siempre disponible para admin) -->
                    <form method="POST" action="/student006/shop/backend/db/db_review_delete.php"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta review?');">
                        <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($review['review_id']); ?>">
                        <button type="submit" class="btn-eliminar-review">
                            🗑️ Eliminar Review
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p>No hay reviews para este videojuego todavía.</p>
<?php endif; ?>

<br/>
<a href="/student006/shop/backend/php/videogames.php" class="enlace-volver">← Volver a Videojuegos</a>

<script src="/student006/shop/js/gestionarReviewsAJAX.js"></script>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>