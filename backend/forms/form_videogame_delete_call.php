<?php 
    $videogame_id = htmlspecialchars($game['videogame_id']); // Obtenemos videogame_id y usamos htmlspecialchars para convertir caracteres especiales y evitar inyección.
?>

<form method="POST" action="/student006/shop/backend/php/videogame_delete.php" style="display:inline;">
    <input type="hidden" name="videogame_id" value="<?php echo $videogame_id; ?>">
    <button type="submit" name="delete">DELETE</button>
</form>