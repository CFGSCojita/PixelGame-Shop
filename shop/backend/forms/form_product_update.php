<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $videogame_id = $_POST['videogame_id']; // Obtener el ID del videojuego desde el formulario

    $sql = "SELECT * FROM videogames WHERE videogame_id = $videogame_id"; // Consulta para obtener los datos del videojuego
    $result = mysqli_query($conn, $sql); // Ejecutar la consulta
    $videogame = mysqli_fetch_assoc($result); // Obtener los datos del videojuego
?>

<h1>Actualizar Videojuego</h1>

<!-- Formulario para actualizar los datos del videojuego -->
<form action="/student006/shop/backend/db/db_product_update.php" method="POST">
    <input type="hidden" name="videogame_id" value="<?php echo $videogame['videogame_id']; ?>">
    
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" maxlength="200" value="<?php echo $videogame['title']; ?>">
    <br/>
    <br/>
    <label for="description">Descripción:</label>
    <textarea id="description" name="description" rows="4" cols="50"><?php echo $videogame['description']; ?></textarea>
    <br/>
    <br/>
    <label for="release_date">Fecha de lanzamiento:</label>
    <input type="date" id="release_date" name="release_date" value="<?php echo $videogame['release_date']; ?>">
    <br/>
    <br/>
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" value="<?php echo $videogame['price']; ?>">
    <br/>
    <br/>
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" value="<?php echo $videogame['stock']; ?>">
    <br/>
    <br/>
    <button type="submit">Actualizar</button>
</form>

<!-- Enlace para volver a la lista de videojuegos -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>