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

    // Obtenemos los datos del formulario.
    $order_id = $_POST['order_id'];
    $videogame_id = $_POST['videogame_id'];
    
    // Obtenemos el título del videojuego para mostrarlo en el formulario.
    $sql = "SELECT title FROM 006_videogames WHERE videogame_id = '$videogame_id'";
    $result = mysqli_query($conn, $sql);
    $videogame = mysqli_fetch_assoc($result);
?>

<h1>Añadir Review</h1>
<h3>Videojuego: <?php echo htmlspecialchars($videogame['title']); ?></h3>

<!-- Formulario para añadir una review -->
<form action="/student006/shop/backend/db/db_review_insert.php" method="POST">
    <!-- Campos ocultos con los IDs necesarios -->
    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
    <input type="hidden" name="videogame_id" value="<?php echo htmlspecialchars($videogame_id); ?>">
    
    <!-- Rating (puntuación de 1 a 5) -->
    <label for="rating">Puntuación (1-5 estrellas):</label>
    <select id="rating" name="rating" required>
        <option value="">-- Selecciona una Valoración --</option>
        <option value="5">⭐⭐⭐⭐⭐ (5 estrellas)</option>
        <option value="4">⭐⭐⭐⭐ (4 estrellas)</option>
        <option value="3">⭐⭐⭐ (3 estrellas)</option>
        <option value="2">⭐⭐ (2 estrellas)</option>
        <option value="1">⭐ (1 estrella)</option>
    </select>
    <br/>
    <br/>

    <!-- Comentario (opcional) -->
    <label for="comment">Comentario (opcional):</label>
    <textarea id="comment" 
              name="comment" 
              rows="6" 
              cols="50" 
              maxlength="500"
              placeholder="Comparte tu opinión sobre el juego..."></textarea>
    <br/>
    <br/>

    <!-- Botón de envío -->
    <button type="submit">Publicar Review</button>
</form>

<br/>
<a href="/student006/shop/backend/php/orders.php">← Volver a Pedidos</a>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>