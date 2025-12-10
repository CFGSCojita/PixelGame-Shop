<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico del manual técnico -->
<link rel="stylesheet" href="/student006/shop/css/manual_tecnico-php.css">

<div class="contenedor-manual">
    
    <h1>Manual Técnico - PixelGame Shop</h1>
    <br/>
    <h2>Funcionalidades Implementadas:</h2>

    <p><strong>Sistema de Autenticación:</strong></p>
    <p class="descripcion-funcionalidad">
        Formulario de login con validación HTML5, gestión de sesiones con roles (guest, customer, admin), password hashing con bcrypt, y protección de rutas mediante verificación de sesión.
    </p>

    <p><strong>CRUD Completo:</strong></p>
    <p class="descripcion-funcionalidad">
        Operaciones completas (Create, Read, Update, Delete) para videojuegos, usuarios, pedidos, carrito y reviews. Los videojuegos y usuarios solo pueden ser gestionados por administradores.
    </p>

    <p><strong>Sistema de Carrito:</strong></p>
    <p class="descripcion-funcionalidad">
        Añadir productos con AJAX, incrementar cantidad sin recargar página, eliminar productos con confirmación, contador dinámico en header, y conversión automática de carrito a pedidos.
    </p>

    <p><strong>Sistema de Reviews:</strong></p>
    <p class="descripcion-funcionalidad">
        Solo usuarios que han comprado pueden valorar productos. Sistema de rating de 1-5 estrellas con comentario opcional. Edición y eliminación de reviews propias. Restricción de 1 review por pedido.
    </p>

    <p><strong>AJAX y API:</strong></p>
    <p class="descripcion-funcionalidad">
        Buscador dinámico de videojuegos, paginación de productos, operaciones de carrito sin recargar página, y gestión completa de reviews con AJAX.
    </p>

    <p><strong>Base de Datos:</strong></p>
    <p class="descripcion-funcionalidad">
        Estructura completa con 7 tablas relacionadas (users, videogames, categories, platforms, cart, orders, reviews) con claves foráneas y restricciones de integridad.
    </p>
    <hr/>
    <br/>
    <h2>Funcionalidades Pendientes de Desarrollo:</h2>

    <p><strong>Checkout Completo:</strong></p>
    <p class="descripcion-funcionalidad">
        Formulario de datos de envío y facturación, selección de método de pago, validación de datos, y confirmación de disponibilidad de stock.
    </p>

    <p><strong>Compra Anónima:</strong></p>
    <p class="descripcion-funcionalidad">
        Permitir checkout sin registro utilizando el role "guest", envío de email de confirmación sin cuenta, y sistema de seguimiento por código único.
    </p>

    <p><strong>Página de Confirmación:</strong></p>
    <p class="descripcion-funcionalidad">
        Vista de resumen del pedido completado con número de seguimiento único y detalles de envío y facturación.
    </p>

    <p><strong>Integración Frontend-Backend:</strong></p>
    <p class="descripcion-funcionalidad">
        Conectar index.html con backend PHP, página de detalle de producto dinámica, sistema de filtros funcional (categorías, plataformas, precio), y galería de imágenes de productos.
    </p>

    <p><strong>Funcionalidades Adicionales:</strong></p>
    <p class="descripcion-funcionalidad">
        Sistema de gestión de imágenes (upload y almacenamiento), panel de cliente con historial completo, sistema de devoluciones (30 días), notificaciones por email, y gestión de direcciones múltiples.
    </p>

</div>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>