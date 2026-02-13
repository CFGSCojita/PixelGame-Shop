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
        Estructura completa con 7 tablas relacionadas (users, videogames, categories, platforms, cart, orders, reviews) con claves foráneas y restricciones de integridad. Tablas adicionales para cross-site selling: suppliers, sellers, product_sellers y weather_logs.
    </p>

    <p><strong>Sistema de Logs:</strong></p>
    <p class="descripcion-funcionalidad">
        Registro automático de eventos de login y logout en ficheros de texto diarios (<code>log_YYYY-MM-DD.txt</code>), almacenados en <code>backend/logs/</code>. Cada entrada incluye fecha, hora y nombre de usuario. Los ficheros se excluyen del repositorio mediante <code>.gitignore</code>.
    </p>

    <p><strong>API AccuWeather:</strong></p>
    <p class="descripcion-funcionalidad">
        Integración con la API de AccuWeather para mostrar el clima actual y el histórico de los últimos días en el footer. Los datos se almacenan en la tabla <code>006_weather_logs</code> como JSON para reducir llamadas a la API externa. El widget se activa bajo demanda con un botón.
    </p>

    <p><strong>Estadísticas con Gráficas:</strong></p>
    <p class="descripcion-funcionalidad">
        Panel de estadísticas para administradores con gráficos de barras generados con Chart.js. Visualiza pedidos por mes, por cliente y por producto. Los datos se obtienen mediante fetch al endpoint <code>get_estadisticas.php</code>, que devuelve JSON con las agregaciones calculadas en SQL.
    </p>

    <p><strong>Email con PHPMailer:</strong></p>
    <p class="descripcion-funcionalidad">
        Envío automático de email de confirmación al realizar un pedido, usando PHPMailer con SMTP (remotehost.es, puerto 587, STARTTLS). El correo incluye un resumen detallado del pedido en formato HTML con tabla de productos, cantidades y total. La configuración se centraliza en <code>backend/config/email_config.php</code>.
    </p>

    <p><strong>Cross-Site Selling (Recepción de productos):</strong></p>
    <p class="descripcion-funcionalidad">
        Sistema de venta cruzada con compañeros de clase. Los productos externos (proveedor Bruno, <code>supplier_id = 2</code>) se sincronizan desde su API (<code>send_Bruno_products.php</code>) y se almacenan en la tabla <code>006_videogames</code> con el <code>supplier_id</code> correspondiente. Se muestran en la sección "Otros Productos" y pueden añadirse al carrito. El endpoint de recepción de pedidos (<code>receive_bruno_orders.php</code>) está preparado pendiente de integración completa.
    </p>

    <hr class="separador"/>

    <h2>Funcionalidades Pendientes de Desarrollo:</h2>

    <p><strong>Cross-Site Selling (Envío de pedidos):</strong></p>
    <p class="descripcion-funcionalidad">
        Cuando un cliente compra un producto de Bruno, el pedido debe enviarse automáticamente a su API (<code>url_send_orders</code> en la tabla <code>006_suppliers</code>). Falta implementar la llamada POST al endpoint externo durante el proceso de checkout.
    </p>

    <p><strong>Checkout Completo:</strong></p>
    <p class="descripcion-funcionalidad">
        Formulario de datos de envío y facturación, selección de método de pago, validación de datos, y confirmación de disponibilidad de stock.
    </p>

    <p><strong>Compra Anónima:</strong></p>
    <p class="descripcion-funcionalidad">
        Permitir checkout sin registro utilizando el role "guest", envío de email de confirmación sin cuenta, y sistema de seguimiento por código único.
    </p>

    <p><strong>Integración Frontend-Backend:</strong></p>
    <p class="descripcion-funcionalidad">
        Página de detalle de producto dinámica, sistema de filtros funcional (categorías, plataformas, precio), y galería de imágenes de productos.
    </p>

    <p><strong>Funcionalidades Adicionales:</strong></p>
    <p class="descripcion-funcionalidad">
        Panel de cliente con historial completo, sistema de devoluciones (30 días), gestión de direcciones múltiples y página de confirmación de pedido con número de seguimiento único.
    </p>

</div>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>