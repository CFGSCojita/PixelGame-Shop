<?php
    // Iniciamos la sesión para poder destruirla.
    session_start();

    // Registramos el logout antes de destruir la sesión.
    if (isset($_SESSION['user_name'])) {
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        require_once($root_DIR . '/student006/shop/backend/functions/log_functions.php');
        write_log($_SESSION['user_name'], 'logout');
    }

    // Destruimos todas las variables de sesión.
    session_unset();

    // Destruimos la sesión.
    session_destroy();

    // Redirigimos al login con mensaje de logout exitoso.
    header('Location: /student006/shop/backend/forms/form_login.php?logout=success');
    exit();
?>