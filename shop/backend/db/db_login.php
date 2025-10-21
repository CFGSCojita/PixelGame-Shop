
<?php
    // Conexión a la base de datos y configuración de sesión.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    include($root_DIR . '/student006/shop/backend/config/session_config.php');

    // Verificamos que se hayan enviado los datos por POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /student006/shop/backend/forms/form_login.php');
        exit();
    }

    // Recogemos los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta simple para buscar al usuario por email.
    $sql = "SELECT user_id, name, email, password, role 
            FROM 006_users 
            WHERE email = '$email'";
    
    $result = mysqli_query($conn, $sql);
    
    // Verificamos si encontramos un usuario con ese email
    if ($result && mysqli_num_rows($result) > 0) {
        
        $user = mysqli_fetch_assoc($result); // Obtenemos los datos del usuario.
        
        // Verificamos la contraseña (comparación directa).
        if ($password === $user['password']) {
            
            // Regeneramos el ID de sesión por seguridad.
            session_regenerate_id(true);
            
            // Guardamos los datos del usuario en la sesión.
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            // Redirigimos al panel de administración.
            header('Location: /student006/shop/backend/index.php');
            exit();
            
        } else {
            header('Location: /student006/shop/backend/forms/form_login.php?error=invalid_credentials');
            exit();
        }
        
    } else {
        header('Location: /student006/shop/backend/forms/form_login.php?error=invalid_credentials');
        exit();
    }

?>