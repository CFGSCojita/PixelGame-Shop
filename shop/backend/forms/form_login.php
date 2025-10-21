<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PixelGame Shop</title>
    
    <style>

        /* Estilos generales */
        body {
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }

        /* Estilos para el formulario */
        form {
            display: inline-block;
            text-align: left;
        }

        /* Estilos para los campos de entrada */
        input {
            display: block;
            margin: 10px 0;
            padding: 8px;
            width: 250px;
        }

        /* Estilos para los botones */
        button {
            margin-top: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Estilos para los mensajes de error */
        .error {
            color: red;
            margin-bottom: 15px;
        }

        /* Estilos para la información de prueba */
        .info {
            color: blue;
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <h1>Login - Panel de Administración</h1>
    <h3>PixelGame Shop</h3>

    <?php
        // Estructura de control 'if'.
        // Si hay un error en la autenticación, lo mostramos. Usamos 'isset' para verificar si la variable existe.
        if (isset($_GET['error'])) {
            echo '<p class="error">';
            // Estructura de control 'switch'.
            // Por cada caso de error, mostramos un mensaje específico.
            switch ($_GET['error']) {
                case 'invalid_credentials':
                    echo 'Email o contraseña incorrectos.';
                    break;
                case 'no_permission':
                    echo 'No tienes permisos para acceder.';
                    break;
                case 'session_required':
                    echo 'Debes iniciar sesión.';
                    break;
            }
            echo '</p>';
        }

        // Estructura de control 'if'.
        // Si se ha cerrado sesión correctamente, mostramos un mensaje de éxito.
        if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
            echo '<p style="color: green;">Has cerrado sesión correctamente.</p>';
        }
    ?>

    <!-- Formulario de inicio de sesión -->
    <form action="/student006/shop/backend/db/db_login.php" method="POST">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Iniciar Sesión</button>
    </form>

    <!-- Información de prueba -->
    <div class="info">
        <strong>Credenciales de prueba:</strong><br>
        Admin: admin@pixelgame.com / admin<br>
        Usuario: user@test.com / user123
    </div>

</body>
</html>