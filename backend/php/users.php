<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/db/db_user_select.php'); // Incluimos el script para seleccionar los usuarios.
?>

<!-- CSS específico de users -->
<link rel="stylesheet" href="/student006/shop/css/users-php.css">

<h1>Usuarios</h1>

<a href="/student006/shop/backend/forms/form_user_insert.php" class="btn-add-user">
    ADD USER
</a>

<hr>

<!-- Si hay usuarios, los mostramos -->
<?php if (!empty($users)): ?>
    <!-- Por cada usuario, mostramos su información -->
    <?php foreach ($users as $user): ?>

        <!-- Entrada del usuario -->
        <div class="user-entry">
            
            <!-- Icono del usuario -->
            <span class="user-image-placeholder">👤</span>

            <!-- Detalles del usuario -->
            <div class="user-details">
                <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                
                <!-- Detalles adicionales del usuario -->
                <p class="info-rol-telefono">
                    Rol: <?php echo htmlspecialchars($user['role']); ?> | 
                    Teléfono: <?php echo htmlspecialchars($user['phone']); ?>
                </p>
                <p class="direccion-usuario">
                    Dirección: <?php echo htmlspecialchars($user['address']); ?>
                </p>
            </div>

            <!-- Acciones del usuario -->
            <div class="user-actions">
                
                <?php 
                    $user_id = htmlspecialchars($user['user_id']); 
                ?>
                
                <!-- UPDATE: Envía directamente al formulario de actualización -->
                <form method="POST" action="/student006/shop/backend/forms/form_user_update.php">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit">UPDATE</button>
                </form>

                <!-- DELETE: Confirmación con JavaScript antes de eliminar -->
                <form method="POST" action="/student006/shop/backend/db/db_user_delete.php"
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

<a href="/student006/shop/backend/index.php" class="enlace-volver">
    Volver al Panel Principal
</a>

<script src="/student006/shop/js/gestionarUsuariosAJAX.js"></script> <!-- Script para gestionar usuarios con AJAX -->

<?php
    mysqli_close($conn);
    
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>