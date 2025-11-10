<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_videogame_select.php'); // Llamamos al fichero db que obtiene los videojuegos.
?>

<h1>Videojuegos</h1>

<a href="/student006/shop/backend/forms/form_videogame_insert.php" style="display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
    ADD VIDEOGAME
</a>

<hr>

<!-- Si hay videojuegos, los mostramos -->
<?php if (!empty($videogames)): ?>
    <!-- Por cada videojuego, mostramos su información -->
    <?php foreach ($videogames as $game): ?>

        <!-- Entrada del videojuego -->
        <div class="videogame-entry" style="display: flex; align-items: center; padding: 15px 0;">
            
            <!-- Imagen del videojuego (placeholder) -->
            <span class="videogame-image-placeholder" style="font-size: 40px; margin-right: 20px;">🎮</span> <!-- Aplicamos un font-size: 40px para la imagen del videojuego -->

            <!-- Detalles del videojuego -->
            <div class="videogame-details" style="flex-grow: 1;"> <!-- Aplicamos un flex-grow: 1 para que ocupe el espacio disponible -->
                <h3><?php echo htmlspecialchars($game['title']); ?></h3> <!-- Obtenemos el título del videojuego con la variable $game['title'] -->
                <p><?php echo htmlspecialchars($game['price']); ?> €</p> <!-- Obtenemos el precio del videojuego con la variable $game['price'] -->
                
                <!-- Detalles adicionales del videojuego. Los obtenemos al igual que los anteriores con la variable $game -->
                <p style="font-size: smaller; color: #555;"> <!-- Aplicamos un estilo más pequeño y gris para la categoría y plataforma -->
                    Categoría: <?php echo htmlspecialchars($game['category_name']); ?> | 
                    Plataforma: <?php echo htmlspecialchars($game['platform_name']); ?>
                </p>
            </div>

            <!-- Acciones del videojuego -->
            <div class="videogame-actions" style="display: flex; flex-direction: column; gap: 5px;">
                
                <?php 
                    // Establecemos el ID para usarlo en los formularios.
                    $videogame_id = htmlspecialchars($game['videogame_id']); 
                ?>
                
                <!-- UPDATE: Envía directamente al formulario de actualización -->
                <form method="POST" action="/student006/shop/backend/forms/form_videogame_update.php" style="display:inline;">
                    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                    <button type="submit">UPDATE</button>
                </form>

                <!-- DELETE: Confirmación con JavaScript antes de eliminar -->
                <form method="POST" action="/student006/shop/backend/db/db_videogame_delete.php" style="display:inline;" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este videojuego?');">
                    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                    <button type="submit">DELETE</button>
                </form>
                <br/>
                <form method="POST" action="/student006/shop/backend/db/db_cart_add.php" style="display:inline;">
                    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                    <button type="submit">AÑADIR AL CARRITO</button>
                </form>
            </div>
        </div>
        <hr> 

    <?php endforeach; ?>
<?php else: ?> <!-- else: Si no hay videojuegos, mostramos un mensaje -->
    <p>No se encontraron videojuegos en la base de datos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" style="display: block; margin-top: 20px;"> <!-- Aplicamos un display block y margin-top para separarlo del contenido anterior -->
    Volver al Panel Principal
</a>

<?php
    mysqli_close($conn); 
    
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>