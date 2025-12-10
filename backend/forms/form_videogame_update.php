<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Estructura de control 'if'.
    // Verificará que se haya recibido el ID del videojuego.
    if (!isset($_POST['videogame_id'])) {
        echo "<p style='color: #FF3366;'>Error: No se ha especificado el ID del videojuego.</p>";
        echo "<a href='/student006/shop/backend/php/videogames.php'>← Volver a Videojuegos</a>";
        require($root_DIR . '/student006/shop/backend/php/footer.php');
        exit();
    }

    $videogame_id = $_POST['videogame_id']; // Obtenemos el ID del videojuego desde el formulario.

    $sql = "SELECT * FROM 006_videogames WHERE videogame_id = $videogame_id"; // Consultamos para obtener los datos del videojuego.
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.
    $videogame = mysqli_fetch_assoc($result); // Obtenemos los datos del videojuego.

    $sql_categories = "SELECT category_id, name FROM 006_categories ORDER BY name"; // Obtenemos las categorías para el select.
    $result_categories = mysqli_query($conn, $sql_categories); // Ejecutamos la consulta.
    $categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC); // Obtenemos todas las categorías.
    mysqli_free_result($result_categories); // Liberamos el resultado.

    $sql_platforms = "SELECT platform_id, name FROM 006_platforms ORDER BY name"; // Obtenemos las plataformas para el select.
    $result_platforms = mysqli_query($conn, $sql_platforms); // Ejecutamos la consulta.
    $platforms = mysqli_fetch_all($result_platforms, MYSQLI_ASSOC); // Obtenemos todas las plataformas.
    mysqli_free_result($result_platforms); // Liberamos el resultado.
?>

<!-- CSS específico del formulario -->
<link rel="stylesheet" href="/student006/shop/css/form_videogame_update-php.css">

<!-- Contenedor del formulario -->
<div class="contenedor-form">
    <h1>Actualizar Videojuego</h1>

    <form action="/student006/shop/backend/db/db_videogame_update.php" method="POST">
        <input type="hidden" name="videogame_id" value="<?php echo $videogame['videogame_id']; ?>">
        
        <!-- Título -->
        <div class="form-elemento">
            <label for="title">Título:</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   maxlength="200" 
                   pattern="[A-Za-zÀ-ÿ0-9\s:,.\-']+" 
                   title="Solo se pueden poner letras, números, espacios y signos de puntuación básicos."
                   value="<?php echo htmlspecialchars($videogame['title']); ?>"
                   required>
        </div>

        <!-- Categoría -->
        <div class="form-elemento">
            <label for="category_id">Categoría:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Selecciona una Categoría --</option>
                <?php foreach ($categories as $category): ?>
                    <option 
                        value="<?php echo htmlspecialchars($category['category_id']); ?>"
                        <?php 
                            if ($category['category_id'] == $videogame['category_id']) {
                                echo 'selected';
                            }
                        ?>
                    >
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
                <?php foreach ($platforms as $platform): ?>
                    <option 
                        value="<?php echo htmlspecialchars($platform['platform_id']); ?>"
                        <?php 
                            if ($platform['platform_id'] == $videogame['platform_id']) {
                                echo 'selected';
                            }
                        ?>
                    >
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
                      required><?php echo htmlspecialchars($videogame['description']); ?></textarea>
        </div>

        <!-- Fecha de lanzamiento -->
        <div class="form-elemento">
            <label for="release_date">Fecha de lanzamiento:</label>
            <input type="date" 
                   id="release_date" 
                   name="release_date" 
                   min="1970-01-01" 
                   max="2030-12-31"
                   value="<?php echo htmlspecialchars($videogame['release_date']); ?>"
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
                   step="0.01"
                   title="El precio del producto debe estar entre 0.99 y 99.99€"
                   value="<?php echo htmlspecialchars($videogame['price']); ?>"
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
                   value="<?php echo htmlspecialchars($videogame['stock']); ?>"
                   required>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn-enviar">Actualizar Videojuego</button>
    </form>

    <!-- Enlace para volver -->
    <a href="/student006/shop/backend/php/videogames.php" class="link-volver">← Volver a Videojuegos</a>
</div>

<?php
    mysqli_close($conn);
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>