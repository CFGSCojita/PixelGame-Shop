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
        const respuesta = await fetch(`${API_BASE_URL}get_videogames.php?pagina=${pagina}`);
        const datos = await respuesta.json();

        const grid = document.querySelector('.productes-grid');
        grid.innerHTML = ''; // Limpiamos el contenido.

        // Bucle 'forEach'.
        // Recorrerá los videojuegos e irá creando las tarjetas.
        datos.videogames.forEach(game => {
            const tarjeta = document.createElement('article');
            tarjeta.className = 'tarjeta-producte';

            let imagenHTML;

            // Estructura de control 'if'.
            // Si el videojuego tiene imagen, la mostramos. Si no, mostramos un placeholder.
            if (game.image_path) {
                imagenHTML = `<img src="/student006/shop/assets/img/${game.image_path}" alt="${game.title}">`;
            } else {
                imagenHTML = `
                    <div style="width: 100%; height: 220px; background: #E6E6E6; display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 3rem; color: #666;">🎮</span>
                    </div>
                `;
            }

            // Rellenamos el contenido HTML de la tarjeta.
            tarjeta.innerHTML = `
                <div class="imatge">
                    ${imagenHTML}
                </div>
                <h3>${game.title}</h3>
                <p style="font-size: 0.85rem; color: #666;">
                    ${game.platform_name} | ${game.category_name}
                </p>
                <p class="preu">${parseFloat(game.price).toFixed(2)}€</p>
                <button class="btn-afegir">Añadir al Carrito</button>
            `;
            
            grid.appendChild(tarjeta); // Añadimos la tarjeta al grid.

            tarjeta.style.cursor = 'pointer';

            const botonAñadir = tarjeta.querySelector('.btn-afegir'); // Seleccionamos el botón de añadir al carrito.

            // Añadimos el evento click al botón de añadir al carrito
            botonAñadir.addEventListener('click', (e) => {
                e.stopPropagation(); // Evitamos que se active el click de la tarjeta
                
                // Creamos el objeto producto con todos sus datos
                const producto = {
                    id: game.videogame_id,
                    title: game.title,
                    price: game.price,
                    platform: game.platform_name,
                    image: game.image_path || null
                };
                
                // Añadimos el producto al carrito usando nuestro sistema
                CarritoManager.añadirProducto(producto);
                
                // Feedback visual: cambiamos el texto del botón temporalmente
                const textoOriginal = botonAñadir.textContent;
                botonAñadir.textContent = '¡Añadido! ✓';
                botonAñadir.style.backgroundColor = '#00CCFF';
                
                // Después de 1 segundo, volvemos al estado original
                setTimeout(() => {
                    botonAñadir.textContent = textoOriginal;
                    botonAñadir.style.backgroundColor = '';
                }, 1000);
            });

            // Añadimos el evento click a la tarjeta para ir a detalle
            tarjeta.addEventListener('click', (e) => {
                // Si NO pulsaron el botón, vamos a detalle:
                if (!e.target.classList.contains('btn-afegir')) {
                    window.location.href = `views/product-detail.html?id=${game.videogame_id}`;
                }
            });
        });

        generarPaginacion(datos.pagina_actual, datos.total_paginas); // Generamos la paginación

    } catch (error) {
        console.error('Error al cargar videojuegos:', error);
    }
}

// Creamos una función para generar los botones de paginación.
function generarPaginacion(actual, total) {
    const contenedor = document.querySelector('.paginacio');
    
    // Estructura de control 'if'
    // Si no existe el contenedor en el HTML, salimos de la función para evitar errores
    if (!contenedor) return;

    contenedor.innerHTML = '';

    // Detectamos el tamaño de la ventana del navegador
    const esMobile = window.innerWidth < 1024;

    // Estructura de control 'if-else'
    // Decidimos qué tipo de paginación mostrar según el dispositivo
    if (esMobile) {

        // Estructura de control 'if'
        // Solo mostramos la flecha "anterior" si NO estamos en la página 1
        if (actual > 1) {
            const btnAnterior = document.createElement('a');
            btnAnterior.href = '#';
            btnAnterior.innerHTML = '&lsaquo;';
            btnAnterior.className = 'btn-pagina';
            
            // Evento click para cargar la página anterior
            btnAnterior.addEventListener('click', (e) => {
                e.preventDefault();
                cargarVideojuegos(actual - 1);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            contenedor.appendChild(btnAnterior);
        }

        // Creamos el elemento que muestra "Página X de Y"
        const indicador = document.createElement('span');
        indicador.className = 'indicador-pagina';
        indicador.textContent = `Página ${actual} de ${total}`;
        contenedor.appendChild(indicador);

        // Estructura de control 'if'
        // Solo mostramos la flecha "siguiente" si NO estamos en la última página
        if (actual < total) {
            const btnSiguiente = document.createElement('a');
            btnSiguiente.href = '#';
            btnSiguiente.innerHTML = '&rsaquo;';
            btnSiguiente.className = 'btn-pagina';
            
            // Evento click para cargar la página siguiente
            btnSiguiente.addEventListener('click', (e) => {
                e.preventDefault();
                cargarVideojuegos(actual + 1);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            contenedor.appendChild(btnSiguiente);
        }

    } else {
        // PAGINACIÓN DESKTOP: Mostramos todos los números de página

        // Botón "Anterior"
        if (actual > 1) {
            const btnAnterior = document.createElement('a');
            btnAnterior.href = '#';
            btnAnterior.textContent = 'Anterior';
            btnAnterior.className = 'btn-pagina';
            
            btnAnterior.addEventListener('click', (e) => {
                e.preventDefault();
                cargarVideojuegos(actual - 1);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            contenedor.appendChild(btnAnterior);
        }

        // Bucle 'for'
        // Creamos un botón por cada página que existe
        for (let i = 1; i <= total; i++) {
            const btnPagina = document.createElement('a');
            btnPagina.href = '#';
            btnPagina.textContent = i;
            btnPagina.className = 'btn-pagina';
            
            // Estructura de control 'if'
            // Si es la página actual, le añadimos la clase 'active'
            if (i === actual) {
                btnPagina.classList.add('active');
            }
            
            // Evento click para cargar esa página específica
            btnPagina.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Estructura de control 'if'
                // Solo cargamos si NO es la página actual
                if (i !== actual) {
                    cargarVideojuegos(i);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
            
            contenedor.appendChild(btnPagina);
        }

        // Botón "Siguiente"
        if (actual < total) {
            const btnSiguiente = document.createElement('a');
            btnSiguiente.href = '#';
            btnSiguiente.textContent = 'Siguiente';
            btnSiguiente.className = 'btn-pagina';
            
            btnSiguiente.addEventListener('click', (e) => {
                e.preventDefault();
                cargarVideojuegos(actual + 1);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            contenedor.appendChild(btnSiguiente);
        }
    }
}

// Ejecutamos la función cuando se carga la página
document.addEventListener('DOMContentLoaded', () => {
    cargarVideojuegos(); // Cargamos la primera página por defecto
});