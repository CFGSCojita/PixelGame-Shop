// Determinamos si estamos en entorno local o remoto:
const esLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

// Definimos la URL base de la API según el entorno:
const API_BASE_URL = esLocal
    ? '/student006/shop/backend/endpoints/' 
    : 'https://remotehost.es/student006/shop/backend/endpoints/';

// Creamos una función para cargar TODOS los videojuegos.
async function cargarTodosVideojuegos() {
    try {
        // Llamada al endpoint sin límite de paginación:
        const respuesta = await fetch(`${API_BASE_URL}get_all_videogames.php`);
        const datos = await respuesta.json();

        const grid = document.querySelector('.productes-grid');
        grid.innerHTML = ''; // Limpiamos el contenido.

        // Recorremos todos los videojuegos y creamos las tarjetas:
        datos.videogames.forEach(game => {
            const tarjeta = document.createElement('article'); // Creamos el elemento tarjeta.
            tarjeta.className = 'tarjeta-producte'; // Asignamos la clase CSS.

            let imagenHTML; // Variable para almacenar el HTML de la imagen.

            // Estructura de control 'if'.
            // Si existe la imagen, la mostramos; si no, mostramos un placeholder.
            if (game.image_path) {
                imagenHTML = `<img src="/student006/shop/assets/img/${game.image_path}" alt="${game.title}">`;
            } else {
                imagenHTML = `
                    <div style="width: 100%; height: 220px; background: #E6E6E6; display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 3rem; color: #666;">🎮</span>
                    </div>
                `;
            }

            // Dibujamos el contenido de la tarjeta con innerHTML:
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
 
            tarjeta.style.cursor = 'pointer'; // Cambiamos el cursor para indicar que es clicable.

            // Evento para redirigir a la página de detalle al hacer clic en la tarjeta (excepto en el botón):
            tarjeta.addEventListener('click', (e) => {
                if (!e.target.classList.contains('btn-afegir')) {
                    window.location.href = `product-detail.html?id=${game.videogame_id}`;
                }
            });
        });

    } catch (error) {
        console.error('Error al cargar videojuegos:', error);
    }
}

// Cargar los videojuegos al cargar la página
document.addEventListener('DOMContentLoaded', cargarTodosVideojuegos);