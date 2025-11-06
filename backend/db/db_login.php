<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Verificamos que se hayan enviado los datos por POST.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /student006/shop/backend/forms/form_login.php'); // Redirigimos al formulario de login.
        exit();
    }

    // Recogemos los datos del formulario.
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta simple para buscar al usuario por email
    $sql = "SELECT user_id, name, email, password, role 
            FROM 006_users 
            WHERE email = '$email'";
    
    $result = mysqli_query($conn, $sql);
    
    // Verificamos si encontramos un usuario con ese email
    if ($result && mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result); // Obtenemos los datos del usuario y usamos fetch para obtenerlos.

        // Verificamos la contraseña.
        if ($password === $user['password']) {
            
            // Guardamos los datos del usuario en la sesión.
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
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