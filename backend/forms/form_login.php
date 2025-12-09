<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PixelGame Shop</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS del Login -->
    <link rel="stylesheet" href="/student006/shop/css/login.css">
</head>
<body>

    <div class="contenedor-login">
        <!-- Cabecera del login -->
        <div class="login-header">
            <h1>Login</h1>
            <h3>PixelGame Shop</h3>
        </div>

        <!-- Estructura de control 'if' -->
        <!-- Obtenemos el parámetro 'error' de la URL, dependiendo del error mostramos un mensaje u otro. -->
        <?php if (isset($_GET['error'])): ?>
            <?php if ($_GET['error'] === 'invalid_credentials'): ?>
                <div class="error-message">
                    Email o contraseña incorrectos
                </div>
            <?php elseif ($_GET['error'] === 'session_required'): ?>
                <div class="error-message">
                    Para acceder, debes iniciar sesión
                </div>
            <?php elseif ($_GET['error'] === 'no_permission'): ?>
                <div class="error-message">
                    No tienes permisos para ingresar
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Mensaje de cierre de sesión -->
        <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
            <div class="success-message">
                Sesión cerrada con éxito.
            </div>
        <?php endif; ?>

        <!-- Formulario de Login -->
        <form action="/student006/shop/backend/db/db_login.php" method="POST" class="login-form">
            
            <!-- Email -->
            <div class="input-group">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="tu@email.com"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="Introduce un email válido"
                    required>
            </div>
            
            <!-- Password -->
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="••••••••"
                    minlength="5"
                    title="La contraseña debe tener al menos 5 caracteres"
                    required>
            </div>
            
            <!-- Botón de envío -->
            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <!-- Footer con enlaces adicionales (opcional) -->
        <div class="login-footer">
            <a href="/student006/shop/index.html">← Volver a la tienda</a>
        </div>
    </div>

</body>
</html>