
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Actualizar Usuario</h1>
<p>Introduce el ID del usuario que deseas actualizar</p>

<!-- Formulario para introducir el ID del usuario a actualizar -->
<form action="/student006/shop/backend/forms/form_user_update.php" method="POST">
    <label for="user_id">ID del Usuario:</label>
    <input type="number" id="user_id" name="user_id" required>
    <button type="submit">Buscar Usuario</button>
</form>

<!-- Enlace para volver a la lista de videojuegos -->
<a href=" /student006/shop/backend/php/videogames.php">
    ← Volver
</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>