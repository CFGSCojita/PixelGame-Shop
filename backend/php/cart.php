<?php
    // Llamada al header y conexión a la base de datos
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    
    // Obtenemos el user_id de la sesión
    $user_id = $_SESSION['user_id'];
    
    // Realizamos una consulta para obtener los productos del carrito
    $sql = "SELECT 
                c.cart_id,
                c.quantity,
                v.title,
                v.price,
                (v.price * c.quantity) as subtotal
            FROM 006_cart c
            JOIN 006_videogames v ON c.videogame_id = v.videogame_id
            WHERE c.user_id = '$user_id'
            ORDER BY c.date_added DESC";
    
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta
?>

<h1>Mi Carrito</h1>

<!-- Estructura de control if -->
 <!-- Si hay productos en el carrito, se irán mostrando. -->
<?php if (mysqli_num_rows($result) > 0): ?>
    
    <!-- Bucle while -->
     <!-- Recorremos cada producto en el carrito -->
    <?php while ($item = mysqli_fetch_assoc($result)): ?>
        <!-- Mostramos la información de cada producto en el carrito -->
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
            <h3><?php echo htmlspecialchars($item['title']); ?></h3>
            <p>Precio: <?php echo $item['price']; ?>€</p>
            <p>Cantidad: <?php echo $item['quantity']; ?></p>
            <p><strong>Subtotal: <?php echo $item['subtotal']; ?>€</strong></p>
            
            <!-- Botón para eliminar un producto del carrito -->
            <form method="POST" action="/student006/shop/backend/db/db_cart_delete.php" style="display:inline;">
                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                <button type="submit">ELIMINAR</button>
            </form>
        </div>
    <?php endwhile; ?>
    
<?php else: ?>
    <p>El carrito está vacío.</p>
<?php endif; ?>

<br>
<a href="/student006/shop/backend/php/videogames.php">← Volver a Videojuegos</a>

<script src="/student006/shop/js/eliminarDelCarritoAJAX.js"></script> <!-- Añadimos el script de AJAX para eliminar del carrito sin refrescar la página. -->

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>