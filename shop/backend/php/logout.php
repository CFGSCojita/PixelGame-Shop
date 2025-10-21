<?php

    // Añadimos la configuración de sesión.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/session_config.php');

    logout(); // Llamamos a la función de cierre de sesión para salir.
?>