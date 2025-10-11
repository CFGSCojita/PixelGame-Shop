
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Añadir Usuario</h1>

<!-- Formulario para añadir un nuevo usuario -->
<form action="/student006/shop/backend/db/db_user_insert.php" method="POST">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" maxlength="200">
    <br/>
    <br/>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" maxlength="200">
    <br/>
    <br/>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" maxlength="200">
    <br/>
    <br/>
    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" maxlength="200">
    <br/>
    <br/>
    <label for="phone">Teléfono:</label>
    <input type="number" id="phone" name="phone">
    <br/>
    <br/>
    <button type="submit">Añadir</button>
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>