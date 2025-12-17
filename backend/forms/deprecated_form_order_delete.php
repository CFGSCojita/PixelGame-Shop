<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Eliminar Pedido</h1>

<?php
    // Se asume que el ID siempre viene del formulario de llamada.
    // Usamos una estructura de control simple para verificar si el ID está presente,
    // aunque la lógica de "buscar el ID si no existe" ya no es necesaria aquí.
    // Si no hay ID, se podría redirigir de vuelta al formulario de llamada o mostrar un error.
    if (!isset($_POST['order_id'])) {
        echo "<p>Error: No se ha especificado el ID del pedido a eliminar.</p>";
        echo "<a href=\"/student006/shop/backend/forms/form_order_delete_call.php\">← Volver a la búsqueda</a>";
    } else {
        $order_id = $_POST['order_id']; // Obtenemos el ID del pedido.
        ?>

        <p>¿Está seguro de que desea eliminar el pedido con ID: <strong><?php echo $order_id; ?></strong>?</p> 
        <p>Esta acción es permanente y no se puede deshacer.</p>

        <form action="/student006/shop/backend/db/db_order_delete.php" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            
            <button type="submit">
                SÍ, ELIMINAR PERMANENTEMENTE
            </button>
        </form>
        
        <br/>

        <a href="/student006/shop/backend/forms/form_order_delete_call.php">← Volver a la búsqueda</a>

        <?php
    }
?>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>