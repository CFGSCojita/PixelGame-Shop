<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Verificamos que se haya recibido el review_id.
    if (!isset($_POST['review_id'])) {
        echo "<p style='color: #FF3366;'>Error: No se ha especificado la review.</p>";
        echo "<a href='/student006/shop/backend/php/orders.php'>← Volver a Pedidos</a>";
        require($root_DIR . '/student006/shop/backend/php/footer.php');
        exit();
    }

    $review_id = $_POST['review_id'];

    // Obtenemos los datos actuales de la review.
    $sql = "SELECT r.rating, r.comment, v.title AS videogame_title
            FROM 006_reviews r
            JOIN 006_videogames v ON r.videogame_id = v.videogame_id
            WHERE r.review_id = '$review_id' AND r.user_id = '{$_SESSION['user_id']}'";

    $result = mysqli_query($conn, $sql);
    $review  = mysqli_fetch_assoc($result);

    // Verificamos que la review exista y pertenezca al usuario actual.
    if (!$review) {
        echo "<p style='color: #FF3366;'>Error: Review no encontrada o no tienes permisos.</p>";
        echo "<a href='/student006/shop/backend/php/orders.php'>← Volver a Pedidos</a>";
        require($root_DIR . '/student006/shop/backend/php/footer.php');
        exit();
    }
?>

<!-- CSS específico del formulario -->
<link rel="stylesheet" href="/student006/shop/css/form_review-php.css">

<!-- Contenedor del formulario -->
<div class="contenedor-form">
    <h1>Editar Review</h1>
    <h3>Videojuego: <?php echo htmlspecialchars($review['videogame_title']); ?></h3>

    <form action="/student006/shop/backend/db/db_review_update.php" method="POST">
        <!-- Campo oculto -->
        <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($review_id); ?>">

        <!-- Rating -->
        <div class="form-elemento">
            <label for="rating">Puntuación (1-5 estrellas):</label>
            <select id="rating" name="rating" required>
                <option value="5" <?php echo $review['rating'] == 5 ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 estrellas)</option>
                <option value="4" <?php echo $review['rating'] == 4 ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 estrellas)</option>
                <option value="3" <?php echo $review['rating'] == 3 ? 'selected' : ''; ?>>⭐⭐⭐ (3 estrellas)</option>
                <option value="2" <?php echo $review['rating'] == 2 ? 'selected' : ''; ?>>⭐⭐ (2 estrellas)</option>
                <option value="1" <?php echo $review['rating'] == 1 ? 'selected' : ''; ?>>⭐ (1 estrella)</option>
            </select>
        </div>

        <!-- Comentario -->
        <div class="form-elemento">
            <label for="comment">Comentario (opcional):</label>
            <textarea id="comment"
                      name="comment"
                      maxlength="500"
                      placeholder="Comparte tu opinión sobre el juego..."><?php echo htmlspecialchars($review['comment']); ?></textarea>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn-enviar">Actualizar Review</button>
    </form>

    <a href="/student006/shop/backend/php/orders.php" class="link-volver">← Volver a Pedidos</a>

    <script src="/student006/shop/js/gestionarReviewsAJAX.js"></script>
</div>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>