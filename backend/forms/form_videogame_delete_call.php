<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Videojuego</h1>
<p>Introduce el ID del videojuego que deseas eliminar</p>

<!-- Formulario para buscar el videojuego -->
<form action="/student006/shop/backend/forms/form_videogame_delete.php" method="POST">
    <label for="videogame_id">ID del Videojuego:</label>
    <input type="number" id="videogame_id" name="videogame_id" required min="1" step="1"
    oninvalid="this.setCustomValidity('El ID debe ser un número entero positivo y no puede estar vacío.');"
    oninput="this.setCustomValidity('');"> 
    <!-- Añadimos validación del ID con la función por defecto 'setCustomValidity()' de JavaScript. Que permite cambiar el cartel de error que normalmente saldría por lo que hemos puesto dentro. -->
    
    <button type="submit">Buscar Videojuego</button>
</form>  

<!-- Enlace para volver a la lista de videojuegos -->
<a href="/student006/shop/backend/php/videogames.php">
    ← Volver a Videojuegos
</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>