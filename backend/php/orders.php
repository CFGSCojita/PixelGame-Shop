<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_order_select.php'); // Llamamos al fichero db que obtiene los pedidos.
?>

<h1>Pedidos</h1>

<?php if ($_SESSION['role'] === 'admin'): ?>
<a href="/student006/shop/backend/forms/form_order_insert.php" style="display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
    ADD ORDER
</a>
<?php endif; ?>

<hr>

<!-- Si hay pedidos, los mostramos -->
<?php if (!empty($orders)): ?>
    <!-- Por cada pedido, mostramos su información -->
    <?php foreach ($orders as $order): ?>

        <!-- Entrada del pedido -->
        <div class="order-entry" style="display: flex; align-items: center; padding: 15px 0;">
            
            <!-- Icono del pedido -->
            <span class="order-image-placeholder" style="font-size: 40px; margin-right: 20px;">📦</span>

            <!-- Detalles del pedido -->
            <div class="order-details" style="flex-grow: 1;">
                <h3>Pedido #<?php echo htmlspecialchars($order['order_id']); ?></h3>
                <p><strong>Videojuego:</strong> <?php echo htmlspecialchars($order['videogame_title']); ?></p>
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($order['user_name']); ?></p>
                
                <!-- Detalles adicionales del pedido -->
                <p style="font-size: smaller; color: #555;">
                    Fecha: <?php echo htmlspecialchars($order['order_date']); ?> | 
                    Cantidad: <?php echo htmlspecialchars($order['quantity']); ?> | 
                    Precio unitario: <?php echo htmlspecialchars($order['unit_price']); ?>€
                </p>
                <p style="font-size: 1.2em; color: green;"><strong>TOTAL: <?php echo htmlspecialchars($order['total']); ?>€</strong></p>
            </div>

            <!-- Acciones del pedido -->
            <div class="order-actions" style="display: flex; flex-direction: column; gap: 5px;">
                
                <?php 
                    // Establecemos el ID para usarlo en los formularios.
                    $order_id = htmlspecialchars($order['order_id']); 
                ?>
                
                <?php if ($_SESSION['role'] === 'admin'): ?>
                <!-- Solo admin puede UPDATE y DELETE -->
                
                <!-- UPDATE: Envía directamente al formulario de actualización -->
                <form method="POST" action="/student006/shop/backend/forms/form_order_update.php" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <button type="submit">UPDATE</button>
                </form>

                <!-- DELETE: Confirmación con JavaScript antes de eliminar -->
                <form method="POST" action="/student006/shop/backend/db/db_order_delete.php" style="display:inline;" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este pedido?');">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <button type="submit">DELETE</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <hr> 

    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron pedidos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" style="display: block; margin-top: 20px;">
    Volver al Panel Principal
</a>

<?php
    mysqli_close($conn); 
    
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>