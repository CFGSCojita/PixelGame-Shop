<?php
    // Llamada a la base de datos y el header a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $user_id = $_POST['user_id']; // Obtenemos el ID del usuario desde el formulario.

    $sql = "SELECT * FROM 006_users WHERE user_id = $user_id"; // Consultamos para obtener los datos del usuario.
    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.
    $user = mysqli_fetch_assoc($result); // Obtenemos los datos del usuario.
?>

<h1>Actualizar Usuario</h1>

<!-- Formulario para actualizar los datos del usuario -->
<form action="/student006/shop/backend/db/db_user_update.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

    <!-- Nombre del usuario -->
    <label for="name">Nombre:</label>
    <input type="text" 
           id="name" 
           name="name" 
           maxlength="200" 
           pattern="[A-Za-zÀ-ÿ\s]+" 
           title="Solo se pueden poner letras y espacios."
           value="<?php echo $user['name']; ?>"
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
           value="<?php echo $user['email']; ?>"
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
           title="La dirección tendría que tener al menos 5 caracteres."
           value="<?php echo $user['address']; ?>">
    <br/>
    <br/>

    <!-- Teléfono -->
    <label for="phone">Teléfono:</label>
    <input type="tel" 
           id="phone" 
           name="phone"
           pattern="[0-9]{9,15}"
           title="El teléfono debe tener entre 9 y 15 dígitos numéricos."
           value="<?php echo $user['phone']; ?>">
    <br/>
    <br/>

    <!-- Botón de envío -->
    <button type="submit">Actualizar</button>
</form>

<!-- Enlace para volver a la lista de usuarios -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>