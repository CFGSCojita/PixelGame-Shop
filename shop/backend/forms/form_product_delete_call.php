<?php

    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Videojuego - PixelGame Shop</title>
</head>
<body>
    <div class="form-container">
        <h1>Eliminar Videojuego</h1>
        
        <div class="warning-box">
            <p>⚠️ Esta acción es irreversible. Ten cuidado.</p>
        </div>
        
        <p style="color: #E6E6E6; text-align: center; margin-bottom: 2rem;">
            Introduce el ID del videojuego que deseas eliminar
        </p>
        
        <form action="/student006/shop/backend/forms/form_product_delete.php" method="GET">
            <div class="form-group">
                <label for="videogame_id">ID del Videojuego:</label>
                <input type="number" id="videogame_id" name="videogame_id" required min="1">
            </div>
            
            <button type="submit" class="btn-submit">Buscar para Eliminar</button>
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