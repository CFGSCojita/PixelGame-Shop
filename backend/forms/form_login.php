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

        /* Estilos del formulario */
        form {
            display: inline-block;
            text-align: left;
        }

        /* Estilos de los inputs */
        input {
            display: block;
            margin: 10px 0;
            padding: 8px;
            width: 250px;
        }
        
        /* Estilos del botón */
        button {
            margin-top: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <h1>Login</h1>
    <h3>PixelGame Shop</h3>

    <!-- Formulario de Login -->
    <form action="/student006/shop/backend/db/db_login.php" method="POST">
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Entrar</button>
    </form>

</body>
</html>