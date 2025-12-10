<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $sql_categories = "SELECT category_id, name FROM 006_categories ORDER BY name"; // Definimos una consulta SQL para obtener las categorías.
    $result_categories = mysqli_query($conn, $sql_categories); // Ejecutamos la consulta.
    $categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC); // Obtenemos todas las categorías como un array asociativo.
    mysqli_free_result($result_categories); // Liberamos el resultado de la consulta.
    
    $sql_platforms = "SELECT platform_id, name FROM 006_platforms ORDER BY name"; // Definimos una consulta SQL para obtener las plataformas.
    $result_platforms = mysqli_query($conn, $sql_platforms); // Ejecutamos la consulta.
    $platforms = mysqli_fetch_all($result_platforms, MYSQLI_ASSOC); // Obtenemos todas las plataformas como un array asociativo.
    mysqli_free_result($result_platforms); // Liberamos el resultado de la consulta.
?>

<!-- CSS específico del formulario -->
<link rel="stylesheet" href="/student006/shop/css/form_videogame_insert-php.css">

<!-- Contenedor del formulario -->
<div class="contenedor-form">
    <h1>Añadir Videojuego</h1>

    <!-- Formulario -->
    <form action="/student006/shop/backend/db/db_videogame_insert.php" method="POST">
        
        <!-- Título -->
        <div class="form-elemento">
            <label for="title">Título:</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   maxlength="200" 
                   pattern="[A-Za-zÀ-ÿ0-9\s:,.\-']+" 
                   title="Solo se pueden poner letras, números, espacios y signos de puntuación básicos."
                   placeholder="Ej: The Legend of Zelda"
                   required>
        </div>

        <!-- Categoría -->
        <div class="form-elemento">
            <label for="category_id">Categoría:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Selecciona una Categoría --</option>
                <!-- Opciones de categorías -->
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['category_id']); ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Plataforma -->
        <div class="form-elemento">
            <label for="platform_id">Plataforma:</label>
            <select id="platform_id" name="platform_id" required>
                <option value="">-- Selecciona una Plataforma --</option>
                <!-- Opciones de plataformas -->
                <?php foreach ($platforms as $platform): ?>
                    <option value="<?php echo htmlspecialchars($platform['platform_id']); ?>">
                        <?php echo htmlspecialchars($platform['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Descripción -->
        <div class="form-elemento">
            <label for="description">Descripción:</label>
            <textarea id="description" 
                      name="description" 
                      minlength="10" 
                      maxlength="1000"
                      placeholder="Describe el videojuego..."
                      required></textarea>
        </div>

        <!-- Fecha de lanzamiento -->
        <div class="form-elemento">
            <label for="release_date">Fecha de lanzamiento:</label>
            <input type="date" 
                   id="release_date" 
                   name="release_date" 
                   min="1970-01-01" 
                   max="2030-12-31"
                   required>
        </div>

        <!-- Precio -->
        <div class="form-elemento">
            <label for="price">Precio (€):</label>
            <input type="number" 
                   id="price" 
                   name="price" 
                   min="0.99" 
                   max="99.99" 
                   step="0.99"
                   title="El precio del producto debe estar entre 0.99 y 99.99€"
                   placeholder="Ej: 59.99"
                   required>
        </div>

        <!-- Stock -->
        <div class="form-elemento">
            <label for="stock">Stock:</label>
            <input type="number" 
                   id="stock" 
                   name="stock" 
                   min="0" 
                   max="999999999"
                   title="Solo se pueden poner números enteros positivos"
                   placeholder="Ej: 100"
                   required>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn-enviar">Añadir Videojuego</button>
    </form>

    <!-- Enlace para volver -->
    <a href="/student006/shop/backend/php/videogames.php" class="link-volver">← Volver a Videojuegos</a>
</div>

<?php
    mysqli_close($conn); 
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>