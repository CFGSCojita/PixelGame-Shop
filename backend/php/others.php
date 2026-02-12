<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');

    // Realizamos una consulta para obtener los productos del proveedor "Bruno" (supplier_id = 2):
    $sql = "SELECT videogame_id, title, price, stock FROM 006_videogames WHERE supplier_id = 2 ORDER BY videogame_id ASC";
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta y obtenemos los resultados.
    $productos = mysqli_fetch_all($result, MYSQLI_ASSOC); // Convertimos los resultados a un array asociativo para facilitar su uso en el HTML.
?>

<!-- CSS específico -->
<link rel="stylesheet" href="/student006/shop/css/others-php.css">

<div class="header-container">
    <h1>Otros Productos</h1>
</div>

<hr>

<!-- Si hay productos, realizamos el bucle para insertar cada uno: -->
<?php if (!empty($productos)): ?>

    <!-- Bucle 'for-each' -->
    <!-- Por cada uno de los productos , insertamos cada dato: -->
    <?php foreach ($productos as $producto): ?>

        <div class="videogame-entry">
            <div class="product-icon">🛋️</div>
            <div class="videogame-details">
                <h3><?php echo htmlspecialchars($producto['title']); ?></h3>
                <p><?php echo htmlspecialchars($producto['price']); ?> €</p>
                <p class="info-secundaria">Stock: <?php echo $producto['stock']; ?> unidades | Proveedor: Bruno</p>
            </div>
            <div class="videogame-actions">
                <form method="POST" action="/student006/shop/backend/db/db_cart_insert.php">
                    <input type="hidden" name="videogame_id" value="<?php echo $producto['videogame_id']; ?>">
                    <button type="submit">AÑADIR AL CARRITO</button>
                </form>
            </div>
        </div>
        <hr>

    <?php endforeach; ?>
<?php else: ?>
    <p>No hay productos externos disponibles.</p>
<?php endif; ?>

<a href="/student006/shop/backend/php/videogames.php" class="enlace-volver">← Volver a Videojuegos</a>

<!-- AJAX para que el formulario no redirija al JSON -->
<script src="/student006/shop/js/gestionarCarritoAJAX.js"></script>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>