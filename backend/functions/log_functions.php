<?php
    date_default_timezone_set("Europe/Madrid"); // Formateamos la hora para que lo indique bien en el fichero.

    // Creamos una función para registrar eventos de login/logout en ficheros diarios:
    function write_log($username, $evento = 'login'): void {

        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        
        $log_dir = $root_DIR . '/student006/shop/backend/logs/';
        $log_file = $log_dir . 'log_' . date('Y-m-d') . '.txt';

        // Estructura de control 'if'.
        // Si la carpeta no existe, la creamos.
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0777, true);
        }

        $fecha = date('Y-m-d H:i:s'); // Guardamos la fecha y hora actual.
        $mensaje = "[$fecha] Usuario $username - $evento" . PHP_EOL; // Formateamos el mensaje a escribir y lo guardamos en una nueva variable.

        // Escribimos en el fichero (FILE_APPEND para añadir al final sin sobrescribir lo anterior).
        file_put_contents($log_file, $mensaje, FILE_APPEND);
    }
?>