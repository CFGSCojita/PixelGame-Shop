<?php
    // Iniciamos la sesión.
    session_start();

    // Creamos una función para registrar el inicio de sesión en un fichero de texto (log.txt).
    // Guardaremos la fecha, hora y nombre de usuario.
    function write_log($username): void {
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];

        // Definimos la ruta de la carpeta de logs dentro de backend
        $log_dir = $root_DIR . '/student006/shop/backend/logs/';
        $log_file = $log_dir . 'log.txt';

        // Estructura de control 'if'.
        // Si la carpeta no existe, la creamos con mkdir().
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0777, true);
        }

        $fecha = date('Y-m-d H:i:s'); // Guardamos la fecha y hora actual.
        $mensaje = "[$fecha] Usuario logeado: $username" . PHP_EOL; // Formateamos el mensaje a escribir y lo guardamos en una nueva variable.

        // Escribimos en el fichero (FILE_APPEND para añadir al final sin sobrescribir lo anterior).
        file_put_contents($log_file, $mensaje, FILE_APPEND);
    }

    // Llamada y conexión a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Verificamos que se hayan enviado los datos por POST.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /student006/shop/backend/forms/form_login.php');
        exit();
    }

    // Recogemos los datos del formulario.
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparamos una consulta para buscar al usuario por email.
    $sql = "SELECT user_id, name, email, password_hash, role 
            FROM 006_users 
            WHERE email = ?";
    
    $result = mysqli_execute_query($conn, $sql, [$email]);
    
    // Verificamos si encontramos un usuario con ese email.
    if ($result && mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result); // Obtenemos los datos del usuario.

        // Verificamos la contraseña con password_verify().
        if (password_verify($password, $user['password_hash'])) {
            
            // Llamamos a la función para apuntar quién ha entrado y cuándo.
            write_log($user['name']);

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