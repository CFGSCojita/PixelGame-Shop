<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $user_id = $_POST['user_id']; // Obtenemos el ID del usuario desde el formulario

    $sql = "SELECT * FROM 006_users WHERE user_id = $user_id"; // Consultamos para obtener los datos del usuario
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta
    $user = mysqli_fetch_assoc($result); // Obtenemos los datos del usuario
?>

<h1>Actualizar Usuario</h1>

<!-- Formulario para actualizar los datos del usuario -->
<form action="/student006/shop/backend/db/db_user_update.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" maxlength="200" value="<?php echo $user['name']; ?>">
    <br/>
    <br/>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" maxlength="200" value="<?php echo $user['email']; ?>">
    <br/>
    <br/>
    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" maxlength="200" value="<?php echo $user['address']; ?>">
    <br/>
    <br/>
    <label for="phone">Teléfono:</label>
    <input type="number" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
    <br/>
    <br/>
    <br/>

    <button type="submit">Actualizar</button>
</form>

<!-- Enlace para volver a la lista de usuarios -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>