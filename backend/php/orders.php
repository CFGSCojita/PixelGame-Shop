<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];

    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_order_select.php'); // Llamamos al fichero db que obtiene los pedidos.
?>

<!-- CSS específico de orders -->
<link rel="stylesheet" href="/student006/shop/css/orders-php.css">

<h1>Pedidos</h1>

<hr>

<!-- Si hay pedidos, los mostramos -->
<?php if (!empty($orders)): ?>
    <!-- Por cada pedido, mostramos su información -->
    <?php foreach ($orders as $order): ?>

        <!-- Entrada del pedido -->
        <div class="order-entry">

            <!-- Icono del pedido -->
            <span class="order-image-placeholder">📦</span>

            <!-- Detalles del pedido -->
            <div class="order-details">
                <h3>Pedido #<?php echo htmlspecialchars($order['order_id']); ?></h3>
                <p><strong>Videojuego:</strong> <?php echo htmlspecialchars($order['videogame_title']); ?></p>
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($order['user_name']); ?></p>

                <!-- Detalles adicionales del pedido -->
                <p class="info-adicional-pedido">
                    Fecha: <?php echo htmlspecialchars($order['order_date']); ?> |
                    Cantidad: <?php echo htmlspecialchars($order['quantity']); ?> |
                    Precio unitario: <?php echo htmlspecialchars($order['unit_price']); ?>€
                </p>
                <p class="total-pedido"><strong>TOTAL: <?php echo htmlspecialchars($order['total']); ?>€</strong></p>
            </div>

            <!-- Acciones del pedido -->
            <div class="order-actions">

                <?php
                // Establecemos el ID para usarlo en los formularios.
                $order_id = htmlspecialchars($order['order_id']);
                $videogame_id = htmlspecialchars($order['videogame_id']);
                ?>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <!-- Solo admin puede UPDATE y DELETE -->

                    <!-- UPDATE: Envía directamente al formulario de actualización -->
                    <form method="POST" action="/student006/shop/backend/forms/form_order_update.php">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <button type="submit">UPDATE</button>
                    </form>

                    <!-- DELETE: Confirmación con JavaScript antes de eliminar -->
                    <form method="POST" action="/student006/shop/backend/db/db_order_delete.php"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este pedido?');">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <button type="submit">DELETE</button>
                    </form>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'customer'): ?>
                    <!-- Solo customer puede gestionar reviews -->

                    <?php if ($order['review_id'] === null): ?>
                        <!-- Si NO tiene review, mostramos botón para crear -->
                        <form method="POST" action="/student006/shop/backend/forms/form_review_insert.php">
                            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                            <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
                            <button type="submit">ADD REVIEW</button>
                        </form>
                    <?php else: ?>
                        <!-- Si YA tiene review, mostramos botones para editar y eliminar -->
                        <form method="POST" action="/student006/shop/backend/forms/form_review_update.php">
                            <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($order['review_id']); ?>">
                            <button type="submit">EDITAR REVIEW</button>
                        </form>

                        <form method="POST" action="/student006/shop/backend/db/db_review_delete.php"
                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta review?');">
                            <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($order['review_id']); ?>">
                            <button type="submit">ELIMINAR REVIEW</button>
                        </form>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
        <hr>

    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron pedidos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" class="enlace-volver">
    Volver al Panel Principal
</a>

<script src="/student006/shop/js/gestionarReviewsAJAX.js"></script>

<?php
    mysqli_close($conn);

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>