<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $videogame_id = $_POST['videogame_id'];

    $sql = "SELECT * FROM 006_videogames WHERE videogame_id = $videogame_id";
    $result = mysqli_query($conn, $sql);
    $videogame = mysqli_fetch_assoc($result);

    $sql_categories = "SELECT category_id, name FROM 006_categories ORDER BY name";
    $result_categories = mysqli_query($conn, $sql_categories);
    $categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);
    mysqli_free_result($result_categories);

    $sql_platforms = "SELECT platform_id, name FROM 006_platforms ORDER BY name";
    $result_platforms = mysqli_query($conn, $sql_platforms);
    $platforms = mysqli_fetch_all($result_platforms, MYSQLI_ASSOC);
    mysqli_free_result($result_platforms);
?>

<h1>Actualizar Videojuego</h1>

<form action="/student006/shop/backend/db/db_videogame_update.php" method="POST">
    <input type="hidden" name="videogame_id" value="<?php echo $videogame['videogame_id']; ?>">
    
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" maxlength="200" value="<?php echo $videogame['title']; ?>">
    <br/>
    <br/>

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
    <br/>
    <br/>

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

<?php
    mysqli_close($conn);
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>