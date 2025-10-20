<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Usuario</h1>

<?php
    // Se asume que el ID siempre viene del formulario de llamada.
    // Usamos una estructura de control simple para verificar si el ID está presente,
    // aunque la lógica de "buscar el ID si no existe" ya no es necesaria aquí.
    // Si no hay ID, se podría redirigir de vuelta al formulario de llamada o mostrar un error.
    if (!isset($_POST['user_id'])) {
        echo "<p>Error: No se ha especificado el ID del usuario a eliminar.</p>";
        echo "<a href=\"/student006/shop/backend/forms/form_user_delete_call.php\">← Volver a la búsqueda</a>";
    } else {
        $user_id = $_POST['user_id']; // Obtenemos el ID del usuario.
        ?>

        <p>¿Está seguro de que desea eliminar el usuario con ID: <strong><?php echo $user_id; ?></strong>?</p> 
        <p>Esta acción es permanente y no se puede deshacer.</p>

        <form action="/student006/shop/backend/db/db_user_delete.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            
            <button type="submit">
                SÍ, ELIMINAR PERMANENTEMENTE
            </button>
        </form>
        
        <br/>

        <a href="/student006/shop/backend/forms/form_user_delete_call.php">← Volver a la búsqueda</a>

        <?php
    }
?>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>