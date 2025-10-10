
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Añadir Videojuego</h1>

<!-- Formulario para añadir un nuevo videojuego -->
<form action="/student006/shop/backend/db/db_videogame_insert.php" method="POST">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" maxlength="200">
    <br/>
    <br/>
    <label for="description">Descripción:</label>
    <textarea id="description" name="description" rows="4" cols="50"></textarea>
    <br/>
    <br/>
    <label for="release_date">Fecha de lanzamiento:</label>
    <input type="date" id="release_date" name="release_date">
    <br/>
    <br/>
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price">
    <br/>
    <br/>
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock">
    <br/>
    <br/>
    <button type="submit">Añadir</button>
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>