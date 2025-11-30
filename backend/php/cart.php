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
    
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: var(--color-card-bg); color: var(--color-text);">
                <th>Videojuego</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total_carrito = 0; // Inicializamos el total del carrito
                
                // Bucle while - Recorremos cada producto en el carrito
                while ($item = mysqli_fetch_assoc($result)): 
                    $total_carrito += $item['subtotal']; // Sumamos al total
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo $item['price']; ?>€</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><strong><?php echo $item['subtotal']; ?>€</strong></td>
                    <td>
                        <!-- Botón para añadir +1 -->
                        <form method="POST" action="/student006/shop/backend/db/db_cart_incrementar.php" style="display:inline;">
                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                            <button type="submit">+</button>
                        </form>
                        
                        <!-- Botón para eliminar -->
                        <form method="POST" action="/student006/shop/backend/db/db_cart_delete.php" style="display:inline;">
                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                            <button type="submit">ELIMINAR</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            
            <!-- Fila del TOTAL -->
            <tr style="background-color: var(--color-primary); color: var(--color-text); font-weight: bold;">
                <td colspan="3" style="text-align: right;">TOTAL:</td>
                <td><?php echo number_format($total_carrito, 2); ?>€</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    
<?php else: ?>
    <p>El carrito está vacío.</p>
<?php endif; ?>

<br>
<a href="/student006/shop/backend/php/videogames.php">← Volver a Videojuegos</a>

<script src="/student006/shop/js/añadirAlCarritoAJAX.js"></script>
<script src="/student006/shop/js/eliminarDelCarritoAJAX.js"></script>
<script src="/student006/shop/js/incrementarCarritoAJAX.js"></script>

<?php
    mysqli_close($conn);
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>