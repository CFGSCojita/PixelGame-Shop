<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico del manual de instalación -->
<link rel="stylesheet" href="/student006/shop/css/manual_instalacion-php.css">

<div class="contenedor-manual">
    
    <h1>Manual de Instalación - PixelGame Shop</h1>

    <!-- REQUISITOS DEL SERVIDOR -->
    <h2>Requisitos del Servidor</h2>

    <p><strong>Sistema Operativo:</strong></p>
    <p class="descripcion-funcionalidad">
        Linux (Ubuntu 20.04 o superior recomendado)
    </p>

    <p><strong>Servidor Web:</strong></p>
    <p class="descripcion-funcionalidad">
        Apache 2.4.62 o superior
    </p>

    <p><strong>Base de Datos:</strong></p>
    <p class="descripcion-funcionalidad">
        MariaDB 11.5.2 o superior (compatible con MySQL 5.x / 8.x / 9.x)
    </p>

    <p><strong>Lenguaje de Programación:</strong></p>
    <p class="descripcion-funcionalidad">
        PHP 8.4.0 o superior con las siguientes extensiones: mod_fcgid/2.3.10-dev, mysqli, session, password_hash
    </p>

    <p><strong>Puerto Configurado:</strong></p>
    <p class="descripcion-funcionalidad">
        Puerto 80 (HTTP) - definido para Apache
    </p>

    <h2>Proceso de Instalación</h2>

    <p><strong>Configuración de la Base de Datos:</strong></p>
    <p class="descripcion-funcionalidad">
        Importar el archivo <code>006_pixelgame_shop.sql</code> en phpMyAdmin o mediante consola MySQL/MariaDB. El puerto por defecto para MariaDB es 3306.
    </p>

    <p><strong>Configuración de Conexión:</strong></p>
    <p class="descripcion-funcionalidad">
        Editar el archivo <code>backend/config/db_connect.php</code> con las credenciales de la base de datos (host: localhost, usuario: root, contraseña: vacía por defecto, base de datos: 006_pixelgame_shop).
    </p>

    <h2>Credenciales de Prueba</h2>

    <p><strong>Usuario Administrador:</strong></p>
    <p class="descripcion-funcionalidad">
        Email: admin@pixelgame.com | Contraseña: admin123 (o la configurada durante la instalación)
    </p>

    <p><strong>Usuario Cliente:</strong></p>
    <p class="descripcion-funcionalidad">
        Email: user@test.com | Contraseña: user123
    </p>

    <h2>Verificación de Instalación</h2>

    <p><strong>Comprobar PHP:</strong></p>
    <p class="descripcion-funcionalidad">
        Acceder a phpinfo() mediante <code>http://localhost/student006/shop/backend/php/phpinfo.php</code> o ejecutar <code>php -v</code> en consola para verificar la versión instalada.
    </p>

    <p><strong>Comprobar Base de Datos:</strong></p>
    <p class="descripcion-funcionalidad">
        Acceder a phpMyAdmin en <code>http://localhost/phpmyadmin</code> y verificar que existe la base de datos <code>006_pixelgame_shop</code> con sus 7 tablas.
    </p>

    <p><strong>Comprobar Apache:</strong></p>
    <p class="descripcion-funcionalidad">
        Verificar que el servidor Apache esté corriendo mediante <code>systemctl status apache2</code> en Linux o revisar el icono de WAMP en Windows.
    </p>

</div>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>