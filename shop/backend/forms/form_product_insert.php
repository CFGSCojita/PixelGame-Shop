
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir un Videojuego (concepto)</title>
</head>
<body>
    <h1>Añadir Videojuego</h1>
    <form action="/student006/shop/backend/db/db_product_insert.php" method="GET">
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
        <input type="number" id="price" name="price" step="4.99">
        <br/>
        <br/>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" step="10">
        <br/>
        <br/>
        <button type="submit">Insertar</button>
    </form>
</body>
</html>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>