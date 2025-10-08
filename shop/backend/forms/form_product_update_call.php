<?php

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Videojuego - PixelGame Shop</title>
</head>
<body>
    <div class="form-container">
        <h1>Actualizar Videojuego</h1>
        <p style="color: #E6E6E6; text-align: center; margin-bottom: 2rem;">
            Introduce el ID del videojuego que deseas actualizar
        </p>
        
        <form action="/student006/shop/backend/forms/form_product_update.php" method="GET">
            <div class="form-group">
                <label for="videogame_id">ID del Videojuego:</label>
                <input type="number" id="videogame_id" name="videogame_id" required min="1">
            </div>
            
            <button type="submit" class="btn-submit">Buscar Videojuego</button>
        </form>
        
        <a href="/student006/shop/backend/php/products.php" class="btn-back">
            ← Volver a Videojuegos
        </a>
    </div>
</body>
</html>

<?php

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');

?>