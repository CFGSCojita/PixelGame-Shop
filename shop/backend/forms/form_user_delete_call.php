
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Usuario</h1>
<p>Introduce el ID del usuario que deseas eliminar</p>

<!-- Formulario para buscar el usuario -->
<form action="/student006/shop/backend/forms/form_user_delete.php" method="POST">
    <label for="user_id">ID del Usuario:</label>
    <input type="number" id="user_id" name="user_id" required>
    
    <button type="submit"">Buscar Usuario</button>
</form>  

<!-- Enlace para volver a la lista de usuarios -->
<a href=" /student006/shop/backend/php/users.php">
    ← Volver a Usuarios
</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
	$root_DIR = $_SERVER['DOCUMENT_ROOT'];
	include($root_DIR . '/student006/shop/backend/php/footer.php');
?>