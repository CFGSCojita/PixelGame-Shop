
// Creamos una función para cargar y renderizar el carrito.
function cargarCarrito() {

    const carrito = CarritoManager.obtenerCarrito(); // Obtenemos el carrito desde el CarritoManager.

    // Obtenemos los elementos del DOM donde se mostrarán los productos y totales:
    const contenedorProductos = document.getElementById('llista-productes');
    const totalItemsElemento = document.getElementById('total-items');
    const subtotalElemento = document.getElementById('subtotal');
    const totalElemento = document.getElementById('total');
    
    // Estructura de control 'if'
    // Si no existe el contenedor, salimos de la función
    if (!contenedorProductos) {
        console.error('No se encontró el contenedor de productos');
        return;
    }
    
    // Limpiamos el contenedor
    contenedorProductos.innerHTML = '';
    
    // Estructura de control 'if'
    // Si el carrito está vacío, mostramos un mensaje
    if (carrito.length === 0) {
        contenedorProductos.innerHTML = `
            <div style="text-align: center; padding: 3rem; grid-column: 1/-1;">
                <p style="font-size: 1.2rem; color: #E6E6E6; margin-bottom: 1rem;">
                    Tu carrito está vacío.
                </p>
            </div>
        `;
        
        // Actualizamos el total de items a 0
        if (totalItemsElemento) totalItemsElemento.textContent = '0';
        if (subtotalElemento) subtotalElemento.textContent = '0.00€';
        if (totalElemento) totalElemento.textContent = '0.00€';
        
        return;
    }
    
    // Bucle 'forEach'
    // Recorremos cada producto del carrito y creamos su tarjeta
    carrito.forEach(producto => {
        const tarjetaProducto = crearTarjetaProducto(producto);
        contenedorProductos.appendChild(tarjetaProducto);
    });
    
    // Actualizamos los totales
    actualizarTotales();
}

// Creamos una función para crear la tarjeta HTML de un producto.
function crearTarjetaProducto(producto) {
    const article = document.createElement('article'); // Creamos el elemento article
    article.className = 'targeta-carret'; // Asignamos la clase CSS
    article.dataset.productId = producto.id; // Asignamos el ID del producto como data attribute
    
    // Construimos el HTML de la imagen
    let imagenHTML; // Declaramos la variable con la imagen en HTML.

    // Estructura de control 'if'
    // Si el producto tiene imagen, la usamos; si no, usamos un placeholder:
    if (producto.image) {
        imagenHTML = `<img src="/student006/shop/assets/img/${producto.image}" alt="${producto.title}">`;
    } else {
        imagenHTML = `
            <div style="width: 100%; height: 100%; background: #E6E6E6; display: flex; align-items: center; justify-content: center;">
                <span style="font-size: 3rem; color: #666;">🎮</span>
            </div>
        `;
    }
    
    // Calculamos el subtotal del producto
    const subtotalProducto = (producto.price * producto.cantidad).toFixed(2);
    
    // Construimos el HTML completo de la tarjeta con el innerHTML:
    article.innerHTML = `
        <!-- Imagen del producto -->
        <div class="imatge-producte">
            ${imagenHTML}
        </div>

        <!-- Información del producto -->
        <div class="info-producte">
            <h3>${producto.title}</h3>
            <span class="plataforma">${producto.platform}</span>
        </div>

        <!-- Controls: precio, cantidad y eliminar -->
        <div class="controls-producte">
            <!-- Precio y botón eliminar -->
            <div class="preu-container">
                <span class="preu">${parseFloat(producto.price).toFixed(2)}€</span>
                <button class="btn-eliminar" data-id="${producto.id}" aria-label="Eliminar producto">
                    <i data-lucide="trash-2"></i>
                </button>
            </div>

            <!-- Control de cantidad -->
            <div class="quantitat-control">
                <button class="btn-quantitat-menos" data-id="${producto.id}" aria-label="Disminuir cantidad">-</button>
                <span class="quantitat-valor">${producto.cantidad}</span>
                <button class="btn-quantitat-mes" data-id="${producto.id}" aria-label="Aumentar cantidad">+</button>
            </div>
            
            <!-- Subtotal del producto -->
            <span class="subtotal-producte">${subtotalProducto}€</span>
        </div>
    `;
    
    // Añadimos los eventos a los botones
    configurarEventosProducto(article, producto.id);
    
    return article; // Devolvemos la tarjeta creada.
}

// Creamos una función para configurar los eventos de los botones de un producto.
function configurarEventosProducto(tarjeta, productoId) {

    // Botón eliminar
    const btnEliminar = tarjeta.querySelector('.btn-eliminar');

    // Añadimos un evento que al hacer clic elimina el producto obteniendo su ID.
    btnEliminar.addEventListener('click', () => {
        eliminarProducto(productoId);
    });
    
    // Botón disminuir cantidad

    // Añadimos un evento que al hacer clic disminuye la cantidad del producto.
    const btnMenos = tarjeta.querySelector('.btn-quantitat-menos');
    btnMenos.addEventListener('click', () => {
        cambiarCantidad(productoId, -1);
    });
    
    // Botón aumentar cantidad
    const btnMas = tarjeta.querySelector('.btn-quantitat-mes');
    
    // Añadimos un evento que al hacer clic aumenta la cantidad del producto.
    btnMas.addEventListener('click', () => {
        cambiarCantidad(productoId, 1);
    });
}

// Creamos una función para eliminar un producto del carrito.
function eliminarProducto(productoId) {
    // Estructura de control 'if'.
    // Pedimos confirmación antes de eliminar el producto.
    if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        CarritoManager.eliminarProducto(productoId); // Eliminamos el producto del carrito
        cargarCarrito(); // Recargamos el carrito
        
        // Reinicializamos los iconos de Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
}

// Creamos una función para cambiar la cantidad de un producto en el carrito.
function cambiarCantidad(productoId, cambio) {
    const carrito = CarritoManager.obtenerCarrito(); // Obtenemos el carrito
    const producto = carrito.find(p => p.id === productoId); // Buscamos el producto por su ID
    
    // Estructura de control 'if'
    // Si encontramos el producto, actualizamos su cantidad
    if (producto) {
        const nuevaCantidad = producto.cantidad + cambio;
        
        // Estructura de control 'if'
        // No permitimos cantidades menores a 1
        if (nuevaCantidad >= 1) {
            CarritoManager.actualizarCantidad(productoId, nuevaCantidad);
            cargarCarrito(); // Recargamos el carrito
            
            // Reinicializamos los iconos de Lucide
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }
    }
}

// Creamos una función para actualizar los totales del carrito.
function actualizarTotales() {
    const totalItems = CarritoManager.obtenerTotalItems(); // Obtenemos el total de items
    const subtotal = CarritoManager.calcularTotal(); // Obtenemos el subtotal del carrito
    
    // Actualizamos el elemento de total de items
    const totalItemsElemento = document.getElementById('total-items');

    // Estructura de control 'if'.
    // Si el elemento existe, actualizamos su contenido:
    if (totalItemsElemento) {
        totalItemsElemento.textContent = totalItems;
    }
    
    // Actualizamos el subtotal
    const subtotalElemento = document.getElementById('subtotal');

    // Estructura de control 'if'.
    // Si el elemento existe, actualizamos su contenido:
    if (subtotalElemento) {
        subtotalElemento.textContent = subtotal.toFixed(2) + '€';
    }
    
    // Por ahora, el total es igual al subtotal (sin envío ni descuentos)
    const totalElemento = document.getElementById('total');

    // Estructura de control 'if'.
    // Si el elemento existe, actualizamos su contenido:
    if (totalElemento) {
        totalElemento.textContent = subtotal.toFixed(2) + '€';
    }
}

// Añadimos un evento que se ejecuta cuando el DOM está completamente cargado.
document.addEventListener('DOMContentLoaded', () => {
    cargarCarrito(); // Cargamos el carrito al iniciar la página.
    
    // Inicializamos los iconos de Lucide después de cargar el carrito
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});

// Al cargar la página, añadimos el evento al botón "Seguir comprando"
document.addEventListener('DOMContentLoaded', () => {
    const btnSeguirComprando = document.querySelector('.btn-seguir-comprant');
    
    // Si existe el botón, añadimos el evento click
    if (btnSeguirComprando) {
        btnSeguirComprando.addEventListener('click', () => {
            window.location.href = '/student006/shop/index.html';
        });
    }
});