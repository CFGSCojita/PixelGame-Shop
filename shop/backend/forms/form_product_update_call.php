
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Actualizar Videojuego</h1>
<p>Introduce el ID del videojuego que deseas actualizar</p>

<!-- Formulario para introducir el ID del videojuego a actualizar -->
<form action="/student006/shop/backend/forms/form_product_update.php" method="POST">
    <label for="videogame_id">ID del Videojuego:</label>
    <input type="number" id="videogame_id" name="videogame_id" required>
    
    <button type="submit"">Buscar Videojuego</button>
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
