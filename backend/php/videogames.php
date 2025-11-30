<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];

    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_videogame_select.php');
?>

<h1>Videojuegos</h1>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="/student006/shop/backend/forms/form_videogame_insert.php" style="display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
        ADD VIDEOGAME
    </a>
<?php endif; ?>

<hr>

<!-- Si hay videojuegos, los mostramos -->
<?php if (!empty($videogames)): ?>
    <?php foreach ($videogames as $game): ?>

        <div class="videogame-entry" style="display: flex; align-items: center; padding: 15px 0;">

            <span class="videogame-image-placeholder" style="font-size: 40px; margin-right: 20px;">🎮</span>

            <div class="videogame-details" style="flex-grow: 1;">
                <h3><?php echo htmlspecialchars($game['title']); ?></h3>
                <p><?php echo htmlspecialchars($game['price']); ?> €</p>

                <p style="font-size: smaller; color: #555;">
                    Categoría: <?php echo htmlspecialchars($game['category_name']); ?> |
                    Plataforma: <?php echo htmlspecialchars($game['platform_name']); ?>
                </p>
            </div>

            <div class="videogame-actions" style="display: flex; flex-direction: column; gap: 5px;">

                <?php $videogame_id = htmlspecialchars($game['videogame_id']); ?>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <!-- Solo admin puede hacer un UPDATE y DELETE -->
                    <form method="POST" action="/student006/shop/backend/forms/form_videogame_update.php" style="display:inline;">
                        <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                        <button type="submit">UPDATE</button>
                    </form>

                    <form method="POST" action="/student006/shop/backend/db/db_videogame_delete.php" style="display:inline;"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este videojuego?');">
                        <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                        <button type="submit">DELETE</button>
                    </form>
                    <br />
                <?php endif; ?>

                <form method="POST" action="/student006/shop/backend/db/db_cart_insert.php" style="display:inline;">
                    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                    <button type="submit">AÑADIR AL CARRITO</button>
                </form>
            </div>
        </div>
        <hr>

    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron videojuegos en la base de datos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" style="display: block; margin-top: 20px;">
    Volver al Panel Principal
</a>

<script src="/student006/shop/js/añadirAlCarritoAJAX.js"></script> <!-- Añadimos el script de AJAX para añadir al carrito sin refrescar la página. -->

<?php
    mysqli_close($conn);

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>