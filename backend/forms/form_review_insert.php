<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Verificamos que se hayan recibido los datos necesarios.
    if (!isset($_POST['order_id']) || !isset($_POST['videogame_id'])) {
        echo "<p style='color: #FF3366;'>Error: Faltan datos necesarios.</p>";
        echo "<a href='/student006/shop/backend/php/orders.php'>← Volver a Pedidos</a>";
        require($root_DIR . '/student006/shop/backend/php/footer.php');
        exit();
    }

    $order_id     = $_POST['order_id'];
    $videogame_id = $_POST['videogame_id'];

    // Obtenemos el título del videojuego para mostrarlo en el formulario.
    $sql = "SELECT title FROM 006_videogames WHERE videogame_id = '$videogame_id'";
    $result = mysqli_query($conn, $sql);
    $videogame = mysqli_fetch_assoc($result);
?>

<!-- CSS específico del formulario -->
<link rel="stylesheet" href="/student006/shop/css/form_review-php.css">

<!-- Contenedor del formulario -->
<div class="contenedor-form">
    <h1>Añadir Review</h1>
    <h3>Videojuego: <?php echo htmlspecialchars($videogame['title']); ?></h3>

    <form action="/student006/shop/backend/db/db_review_insert.php" method="POST">
        <!-- Campos ocultos -->
        <input type="hidden" name="order_id"     value="<?php echo htmlspecialchars($order_id); ?>">
        <input type="hidden" name="videogame_id" value="<?php echo htmlspecialchars($videogame_id); ?>">

        <!-- Rating -->
        <div class="form-elemento">
            <label for="rating">Puntuación (1-5 estrellas):</label>
            <select id="rating" name="rating" required>
                <option value="">-- Selecciona una Valoración --</option>
                <option value="5">⭐⭐⭐⭐⭐ (5 estrellas)</option>
                <option value="4">⭐⭐⭐⭐ (4 estrellas)</option>
                <option value="3">⭐⭐⭐ (3 estrellas)</option>
                <option value="2">⭐⭐ (2 estrellas)</option>
                <option value="1">⭐ (1 estrella)</option>
            </select>
        </div>

        <!-- Comentario -->
        <div class="form-elemento">
            <label for="comment">Comentario (opcional):</label>
            <textarea id="comment"
                      name="comment"
                      maxlength="500"
                      placeholder="Comparte tu opinión sobre el juego..."></textarea>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn-enviar">Publicar Review</button>
    </form>

    <a href="/student006/shop/backend/php/orders.php" class="link-volver">← Volver a Pedidos</a>

    <script src="/student006/shop/js/gestionarReviewsAJAX.js"></script>
</div>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>