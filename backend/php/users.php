<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_user_select.php'); // Incluimos el script para seleccionar los usuarios.
?>

<h1>Usuarios</h1>

<a href="/student006/shop/backend/forms/form_user_insert.php" style="display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
    ADD USER
</a>

<hr>

<!-- Si hay usuarios, los mostramos -->
<?php if (!empty($users)): ?>
    <!-- Por cada usuario, mostramos su información -->
    <?php foreach ($users as $user): ?>

        <!-- Entrada del usuario -->
        <div class="user-entry" style="display: flex; align-items: center; padding: 15px 0;">
            
            <!-- Icono del usuario -->
            <span class="user-image-placeholder" style="font-size: 40px; margin-right: 20px;">👤</span>

            <!-- Detalles del usuario -->
            <div class="user-details" style="flex-grow: 1;">
                <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                
                <!-- Detalles adicionales del usuario -->
                <p style="font-size: smaller; color: #555;">
                    Rol: <?php echo htmlspecialchars($user['role']); ?> | 
                    Teléfono: <?php echo htmlspecialchars($user['phone']); ?>
                </p>
                <p style="font-size: 0.9em; color: #666;">
                    Dirección: <?php echo htmlspecialchars($user['address']); ?>
                </p>
            </div>

            <!-- Acciones del usuario -->
            <div class="user-actions" style="display: flex; flex-direction: column; gap: 5px;">
                
                <?php 
                    $user_id = htmlspecialchars($user['user_id']); 
                ?>
                
                <!-- UPDATE: Envía directamente al formulario de actualización -->
                <form method="POST" action="/student006/shop/backend/forms/form_user_update.php" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit">UPDATE</button>
                </form>

                <!-- DELETE: Confirmación con JavaScript antes de eliminar -->
                <form method="POST" action="/student006/shop/backend/db/db_user_delete.php" style="display:inline;" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit">DELETE</button>
                </form>
            </div>
        </div>
        <hr> 

    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron usuarios en la base de datos.</p>
<?php endif; ?>

<a href="/student006/shop/backend/index.php" style="display: block; margin-top: 20px;">
    Volver al Panel Principal
</a>

<?php
    mysqli_close($conn);
    
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>