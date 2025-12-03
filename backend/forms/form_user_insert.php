<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<h1>Añadir Usuario</h1>

<!-- Formulario para añadir un nuevo usuario -->
<form action="/student006/shop/backend/db/db_user_insert.php" method="POST">
    <!-- Nombre del usuario -->
    <label for="name">Nombre:</label>
    <input type="text" 
           id="name" 
           name="name" 
           maxlength="200" 
           pattern="[A-Za-zÀ-ÿ\s]+" 
           title="Solo se pueden poner letras y espacios."
           required>
    <br/>
    <br/>

    <!-- Correo electrónico -->
    <label for="email">Correo electrónico:</label>
    <input type="email" 
           id="email" 
           name="email" 
           maxlength="200"
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
           title="Introduce un email válido."
           required>
    <br/>
    <br/>

    <!-- Contraseña -->
    <label for="password">Contraseña:</label>
    <input type="password" 
           id="password" 
           name="password" 
           maxlength="200" 
           minlength="6"
           title="La contraseña debe tener al menos 6 caracteres."
           required>
    <br/>
    <br/>

    <!-- Dirección -->
    <label for="address">Dirección:</label>
    <input type="text" 
           id="address" 
           name="address" 
           maxlength="200"
           minlength="5"
           title="La dirección tendría que tener al menos 5 caracteres.">
    <br/>
    <br/>

    <!-- Teléfono -->
    <label for="phone">Teléfono:</label>
    <input type="tel" 
           id="phone" 
           name="phone"
           pattern="[0-9]{9,15}"
           title="El teléfono debe tener al menos 9 y 15 dígitos numéricos.">
    <br/>
    <br/>

    <!-- Botón de envío -->
    <button type="submit">Añadir</button>
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>