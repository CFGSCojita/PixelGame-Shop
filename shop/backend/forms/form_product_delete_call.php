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
    <style>
        .form-container {
            max-width: 600px;
            margin: 3rem auto;
            background-color: #1A1A1A;
            padding: 2rem;
            border-radius: 8px;
            border: 2px solid #2A2A2A;
        }
        
        .form-container h1 {
            color: #FCFCFC;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
        }
        
        .warning-box {
            background-color: rgba(255, 51, 102, 0.1);
            border: 2px solid #FF3366;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        
        .warning-box p {
            color: #FF3366;
            margin: 0;
            text-align: center;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            color: #E6E6E6;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            background-color: #0A0A0A;
            border: 1px solid #2A2A2A;
            border-radius: 5px;
            color: #FCFCFC;
            font-size: 1rem;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF3366;
        }
        
        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background-color: #FF3366;
            color: #FCFCFC;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background-color: #cc2952;
            transform: translateY(-2px);
        }
        
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #00CCFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .btn-back:hover {
            color: #FF3366;
        }
    </style>
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