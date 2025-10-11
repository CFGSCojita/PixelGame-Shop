
<!-- Llamada al header y conexión a la base de datos. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Usuarios</h1>

<!-- Enlaces a las diferentes operaciones para gestionar usuarios. -->
<a href="/student006/shop/backend/forms/form_user_insert.php">
    <span>Insertar Usuario</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_user_select.php">
    <span>Listar Usuarios</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_user_update_call.php">
    <span>Actualizar Usuario</span>
    <span>&gt;</span>
</a>
<br/>
<a href="/student006/shop/backend/forms/form_user_delete_call.php">
    <span>Eliminar Usuario</span>
    <span>&gt;</span>
</a>
<br/>
<br/>
<!-- Enlace para volver al panel principal. -->
<a href="/student006/shop/backend/php/index.php">
    Volver al Panel Principal
</a>

<!-- Llamada al footer. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>