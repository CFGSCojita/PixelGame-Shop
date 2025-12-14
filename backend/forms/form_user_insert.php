<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico del formulario -->
<link rel="stylesheet" href="/student006/shop/css/form_user_insert-php.css">

<!-- Contenedor del formulario -->
<div class="contenedor-form">
    <h1>Añadir Usuario</h1>

    <!-- Formulario para añadir un nuevo usuario -->
    <form action="/student006/shop/backend/db/db_user_insert.php" method="POST">
        
        <!-- Nombre del usuario -->
        <div class="form-elemento">
            <label for="name">Nombre:</label>
            <input type="text" 
                   id="name" 
                   name="name"
                   minlength="5" 
                   maxlength="20" 
                   pattern="[A-Za-zÀ-ÿ\s]+" 
                   title="Solo se pueden poner letras y espacios."
                   placeholder="Ej: Juan Pérez"
                   required>
        </div>

        <!-- Correo electrónico -->
        <div class="form-elemento">
            <label for="email">Correo electrónico:</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   maxlength="20"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                   title="Introduce un email válido."
                   placeholder="ejemplo@correo.com"
                   required>
        </div>

        <!-- Contraseña -->
        <div class="form-elemento">
            <label for="password">Contraseña:</label>
            <input type="password" 
                id="password" 
                name="password" 
                maxlength="200" 
                minlength="6"
                pattern="(?=.*\d)(?=.*[\W_]).{6,}"
                title="La contraseña debe tener al menos 6 caracteres, incluir un número y un carácter especial (!@#$%^&*)"
                placeholder="Mínimo 6 caracteres, 1 número y 1 carácter especial"
                required>
        </div>

        <!-- Dirección -->
        <div class="form-elemento">
            <label for="address">Dirección (opcional):</label>
            <input type="text" 
                   id="address" 
                   name="address" 
                   maxlength="50"
                   minlength="5"
                   title="La dirección tendría que tener al menos 5 caracteres."
                   placeholder="Calle, número, ciudad">
        </div>

        <!-- Teléfono -->
        <div class="form-elemento">
            <label for="phone">Teléfono (opcional):</label>
            <input type="tel" 
                   id="phone" 
                   name="phone"
                   pattern="[0-9]{9,15}"
                   title="El teléfono debe tener entre 9 y 15 dígitos numéricos."
                   placeholder="Ej: 612345678">
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn-enviar">Añadir Usuario</button>
    </form>

    <!-- Enlace para volver -->
    <a href="/student006/shop/backend/php/users.php" class="link-volver">← Volver a Usuarios</a>

    <script src="/student006/shop/js/gestionarUsuariosAJAX.js"></script> <!-- Script para gestionar usuarios con AJAX -->
</div>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>