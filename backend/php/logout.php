<?php
    // Iniciamos la sesión para poder destruirla.
    session_start();

    // Destruimos todas las variables de sesión.
    session_unset();

    // Destruimos la sesión.
    session_destroy();

    // Redirigimos al login con mensaje de logout exitoso.
    header('Location: /student006/shop/backend/forms/form_login.php?logout=success');
    exit();
?>