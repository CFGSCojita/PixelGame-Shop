
// Determinamos si estamos en entorno local o remoto.    
const esLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

// Definimos la URL base de la API según el entorno.
const API_BASE_URL = esLocal
    ? '/student006/shop/backend/endpoints/' 
    : 'https://remotehost.es/student006/shop/backend/endpoints/';

// Función para cargar videojuegos desde la API
async function cargarVideojuegos(pagina = 1) {
    // Estructura 'try-catch'.
    // Intentará obtener la respuesta de la API y crear las tarjetas. En caso de que haya algún error, lo capturará.
    try {
        // Llamada al endpoint de la API
        const respuesta = await fetch(`${API_BASE_URL}get_videogames.php?pagina=${pagina}`); // Incluimos el parámetro de página.
        const datos = await respuesta.json(); // Suponemos que la respuesta es un JSON.

        const grid = document.querySelector('.productes-grid'); // Obtener la grid de los productos con document.
        grid.innerHTML = ''; // Limpiamos el contenido.

        // Bucle 'forEach'.
        // Recorrerá los videojuegos e irá creando las tarjetas.
        datos.videogames.forEach(game => {
            const tarjeta = document.createElement('article'); // Creamos un elemento 'article' para cada videojuego.
            tarjeta.className = 'tarjeta-producte'; // Asignamos la clase CSS.

            // Rellenamos el contenido de la tarjeta con los datos del videojuego:
            tarjeta.innerHTML = `
                <div class="imatge">
                    <div style="width: 100%; height: 100%; background: #E6E6E6; display: flex; align-items: center; justify-content: center; color: #666;">
                        <span style="font-size: 3rem; display: block; transform: translateY(150%);">🎮</span>
                    </div>
                </div>
                <h3>${game.title}</h3>
                <p style="font-size: 0.85rem; color: #666;">
                    ${game.platform_name} | ${game.category_name}
                </p>
                <p class="preu">${parseFloat(game.price).toFixed(2)}€</p>
                <button class="btn-afegir">Añadir al Carrito</button>
            `;
            grid.appendChild(tarjeta); // Añadimos la tarjeta a la grid.
        });

        generarPaginacion(datos.pagina_actual, datos.total_paginas); // Llamamos a la función para generar la paginación.

    } catch (error) {
        console.error('Error al cargar videojuegos:', error); // Mostramos el error en la consola.
    }
}

// Creamos una función para generar los botones de paginación.
function generarPaginacion(actual, total) {
    // Obtenemos el contenedor HTML donde se insertarán los botones
    const contenedor = document.querySelector('.paginacio');
    
    // Estructura de control 'if'
    // Si no existe el contenedor en el HTML, salimos de la función para evitar errores
    if (!contenedor) return;

    // Limpiamos todo el contenido anterior del contenedor
    // Esto evita que se dupliquen los botones cada vez que cambiamos de página
    contenedor.innerHTML = '';

    // Detectamos el tamaño de la ventana del navegador
    // Si es menor a 1024px, consideramos que es móvil o tablet
    const esMobile = window.innerWidth < 1024;

    // Estructura de control 'if-else'
    // Decidimos qué tipo de paginación mostrar según el dispositivo
    if (esMobile) {

        // Estructura de control 'if'
        // Solo mostramos la flecha "anterior" si NO estamos en la página 1
        if (actual > 1) {
            const btnAnterior = document.createElement('a'); // Creamos un enlace
            btnAnterior.href = '#'; // Le damos un href vacío
            btnAnterior.innerHTML = '&lsaquo;'; // Símbolo de flecha izquierda (‹)
            btnAnterior.className = 'btn-pagina'; // Le asignamos la clase CSS
            
            // Agregamos un evento click para cargar la página anterior
            btnAnterior.addEventListener('click', (e) => {
                e.preventDefault(); // Evitamos que el enlace recargue la página
                cargarVideojuegos(actual - 1); // Cargamos la página anterior (actual - 1)
            });
            
            contenedor.appendChild(btnAnterior); // Añadimos el botón al contenedor
        }

        // Mostramos el número de página actual y el total
        // Ejemplo: "3 / 8" significa que estamos en la página 3 de 8
        const paginaActual = document.createElement('span'); // Creamos un span (no es clickeable)
        paginaActual.textContent = `${actual} / ${total}`; // Texto: "página actual / total"
        paginaActual.className = 'btn-pagina activo'; // Le damos estilo de botón activo (rosa)
        contenedor.appendChild(paginaActual); // Lo añadimos al contenedor

        // Estructura de control 'if'
        // Solo mostramos la flecha "siguiente" si NO estamos en la última página
        if (actual < total) {
            const btnSiguiente = document.createElement('a'); // Creamos un enlace
            btnSiguiente.href = '#'; // Le damos un href vacío
            btnSiguiente.innerHTML = '&rsaquo;'; // Símbolo de flecha derecha (›)
            btnSiguiente.className = 'btn-pagina'; // Le asignamos la clase CSS
            
            // Agregamos un evento click para cargar la página siguiente
            btnSiguiente.addEventListener('click', (e) => {
                e.preventDefault(); // Evitamos que el enlace recargue la página
                cargarVideojuegos(actual + 1); // Cargamos la página siguiente (actual + 1)
            });
            
            contenedor.appendChild(btnSiguiente); // Añadimos el botón al contenedor
        }

    } else {
        
        // Bucle 'for'
        // Iteramos desde 1 hasta el total de páginas para crear un botón por cada página
        for (let i = 1; i <= total; i++) {
            const boton = document.createElement('a'); // Creamos un enlace para cada número
            boton.href = '#'; // Le damos un href vacío
            boton.textContent = i; // El texto del botón es el número de página (1, 2, 3...)
            
            // Operador ternario (if corto)
            // Si 'i' es igual a la página actual, le ponemos clase 'activo' (rosa)
            // Si no, le ponemos solo 'btn-pagina' (gris oscuro)
            boton.className = i === actual ? 'btn-pagina activo' : 'btn-pagina';
            
            // Agregamos un evento click para cargar la página correspondiente
            boton.addEventListener('click', (e) => {
                e.preventDefault(); // Evitamos que el enlace recargue la página
                cargarVideojuegos(i); // Cargamos la página del número clickeado
            });

            contenedor.appendChild(boton); // Añadimos el botón al contenedor
        }
    }
}

// Cargamos los videojuegos cuando la página esté lista con document.
document.addEventListener('DOMContentLoaded', () => {
    cargarVideojuegos(1); // Página 1 por defecto.
});