<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];

    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_videogame_select.php');
?>

<!-- CSS específico de videogames -->
<link rel="stylesheet" href="/student006/shop/css/videogames-php.css">

<!-- Contenedor con título y botón -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1 style="margin: 0;">Videojuegos</h1>
    
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="/student006/shop/backend/php/estadisticas.php" class="btn-estadisticas">
            📊 Ver Estadísticas
        </a>
    <?php endif; ?>
</div>

<hr>

<!-- Buscador -->
<div class="contenedor-buscador">
    <label for="buscador">Buscar videojuego:</label>
    <input type="text" 
           id="buscador" 
           class="input-buscador"
           onkeyup="filtrarVideojuegos(this.value)" 
           placeholder="Escribe el nombre del juego...">
    <div id="resultado-busqueda"></div>
</div>
<br/>
<?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="/student006/shop/backend/forms/form_videogame_insert.php" class="btn-add-videogame">
        ADD VIDEOGAME
    </a>
<?php endif; ?>

<hr>

<!-- Si hay videojuegos, los mostramos -->
<?php if (!empty($videogames)): ?>
    <?php foreach ($videogames as $game): ?>

        <div class="videogame-entry">

            <!-- Estructura de control 'if' -->
            <!-- Si el videojuego tiene imagen, la mostramos. Si no, mostramos el placeholder. -->
            <?php if (!empty($game['image_path'])): ?>
                <img src="/student006/shop/assets/img/<?php echo htmlspecialchars($game['image_path']); ?>" 
                    alt="<?php echo htmlspecialchars($game['title']); ?>" 
                    class="videogame-image">
            <?php else: ?>
                <span class="videogame-image-placeholder">🎮</span>
            <?php endif; ?>

            <div class="videogame-details">
                <h3><?php echo htmlspecialchars($game['title']); ?></h3>
                <p><?php echo htmlspecialchars($game['price']); ?> €</p>

                <p class="info-secundaria">
                    Categoría: <?php echo htmlspecialchars($game['category_name']); ?> |
                    Plataforma: <?php echo htmlspecialchars($game['platform_name']); ?>
                </p>
            </div>

            <div class="videogame-actions">

                <?php $videogame_id = htmlspecialchars($game['videogame_id']); ?>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <!-- Solo admin puede hacer un UPDATE y DELETE -->
                    <form method="POST" action="/student006/shop/backend/forms/form_videogame_update.php">
                        <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                        <button type="submit">UPDATE</button>
                    </form>

                    <form method="POST" action="/student006/shop/backend/db/db_videogame_delete.php"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este videojuego?');">
                        <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                        <button type="submit">DELETE</button>
                    </form>
                    <br />
                <?php endif; ?>

                <form method="POST" action="/student006/shop/backend/db/db_cart_insert.php">
                    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                    <button type="submit">AÑADIR AL CARRITO</button>
                </form>

                <?php if ($game['review_count'] > 0): ?>
                    <!-- Solo mostramos el botón si hay reviews -->
                    <form method="POST" action="/student006/shop/backend/php/reviews.php">
                        <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                        <button type="submit">VER TODAS LAS REVIEWS (<?php echo $game['review_count']; ?>)</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <hr>

    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron videojuegos en la base de datos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" class="enlace-volver">
    Volver al Panel Principal
</a>

<script src="/student006/shop/js/gestionarCarritoAJAX.js"></script> <!-- Script para gestionar el carrito con AJAX -->
<script src="/student006/shop/js/gestionarVideojuegosAJAX.js"></script> <!-- Script para gestionar el formulario mediante AJAX -->
<script src="/student006/shop/js/buscarVideojuegos.js"></script> <!-- Script para que funcione el buscador de videojuegos -->

<?php
    mysqli_close($conn);

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>