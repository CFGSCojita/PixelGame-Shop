<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico -->
<link rel="stylesheet" href="/student006/shop/css/others-php.css">

<!-- Título -->
<div class="header-container">
    <h1>Otros Productos</h1>
</div>

<hr>

<!-- Contenedor de productos externos -->
<div id="productos-externos">
    <p class="mensaje-cargando">Cargando productos...</p>
</div>

<hr>

<!-- Enlace volver -->
<a href="/student006/shop/backend/php/videogames.php" class="enlace-volver">← Volver a Videojuegos</a>

<!-- JavaScript para cargar productos -->
<script>
    cargarProductosExternos(); // Llamamos a la función para cargar los productos externos al cargar la página.
    
    // Creamos una función para cargar productos de Bruno desde la BD:
    function cargarProductosExternos() {
        // Hacemos una petición fetch al endpoint que devuelve los productos externos:
        fetch('/student006/shop/backend/endpoints/get_external_products.php')
            .then(response => response.json()) // Parseamos la respuesta como JSON.
            // Si la respuesta es exitosa, llamamos a la función mostrarProductos con los datos recibidos.
            .then(data => { 
                mostrarProductos(data);
            })
            // Si ocurre un error durante la petición, mostramos un mensaje de error en el contenedor.
            .catch(error => {
                document.getElementById('productos-externos').innerHTML = 
                    '<p class="mensaje-error">Error al cargar productos externos</p>';
            });
    }
    
    // Creamos una función para mostrar los productos en el HTML:
    function mostrarProductos(productos) {
        const contenedor = document.getElementById('productos-externos'); // Obtenemos el contenedor donde se mostrarán los productos.
        
        // Estructura de control 'if'.
        // Si no hay productos, mostramos un mensaje indicando que no hay productos disponibles.
        if (productos.length === 0) {
            contenedor.innerHTML = '<p class="mensaje-vacio">No hay productos externos disponibles</p>';
            return;
        }
        
        let html = ''; // Creamos una variable para almacenar el HTML que se generará dinámicamente.

        // Recorremos el array de productos utilizando un bucle 'forEach' y generamos el HTML para cada producto.
        productos.forEach(producto => {
            html += `
                <div class="product-entry">
                    <div class="product-icon">🛋️</div>
                    <div class="product-details">
                        <h3>${producto.title}</h3>
                        <p><strong>Precio:</strong> ${producto.price}€</p>
                        <p><strong>Stock:</strong> ${producto.stock} unidades</p>
                        <p class="info-secundaria">Proveedor: ${producto.supplier || 'Bruno'}</p>
                    </div>
                </div>
                <hr>
            `;
        });
        
        contenedor.innerHTML = html; // Insertamos el HTML generado en el contenedor.
    }
</script>

<?php require($root_DIR . '/student006/shop/backend/php/footer.php'); ?>