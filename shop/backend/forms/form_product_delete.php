
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Videojuego</h1>

<?php

    // Estructura de control 'if'.
    // Si se ha enviado el ID del videojuego a través del formulario, mostramos un mensaje de confirmación para eliminar el videojuego.
    // Si no, mostramos el formulario para introducir el ID del videojuego que se desea eliminar
    if (isset($_POST['videogame_id'])) {
        $videogame_id = $_POST['videogame_id']; // Obtenemos el ID del videojuego enviado por el formulario.
        ?>
        
        <p>¿Está seguro de que desea eliminar el videojuego con ID: <strong><?php echo $videogame_id; ?></strong>?</p> 
        <p>Esta acción es permanente y no se puede deshacer.</p>

        <!-- Formulario para confirmar la eliminación del videojuego -->
        <form action="/student006/shop/backend/db/db_product_delete.php" method="POST">
            <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
            
            <button type="submit">
                SÍ, ELIMINAR PERMANENTEMENTE
            </button>
        </form>
        
        <br/>

        <!-- Enlace para volver al formulario de búsqueda -->
        <a href="/student006/shop/backend/forms/form_product_delete.php">← Volver</a>
        
        <?php
    } else {
        ?>
        
        <p>Introduce el ID del videojuego que deseas eliminar</p>

        <!-- Formulario para introducir el ID del videojuego a eliminar -->
        <form action="/student006/shop/backend/forms/form_product_delete.php" method="POST">
            <label for="videogame_id">ID del Videojuego:</label>
            <input type="number" id="videogame_id" name="videogame_id" required>
            <br><br>
            <button type="submit">Buscar Videojuego</button>
        </form>
        
        <?php
    }
?>

<br>

<!-- Enlace para volver a la lista de videojuegos -->
<a href="/student006/shop/backend/php/videogames.php">← Volver a Videojuegos</a>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>