
// Determinamos si estamos en entorno local o remoto
const esLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

// Definimos la URL base de la API según el entorno
const API_BASE_URL = esLocal
    ? '/student006/shop/backend/endpoints/' 
    : 'https://remotehost.es/student006/shop/backend/endpoints/';

// Obtenemos el parámetro 'id' de la URL
// Ejemplo: product-detail.html?id=5 → idVideojuego = 5
const parametrosURL = new URLSearchParams(window.location.search);
const idVideojuego = parametrosURL.get('id');

// Función para cargar los detalles del videojuego
async function cargarDetalle() {
    try {
        // Hacemos la petición al endpoint con el ID del videojuego
        const respuesta = await fetch(`${API_BASE_URL}get_videogame_detail.php?id=${idVideojuego}`);
        const videojuego = await respuesta.json();
        
        // Rellenamos el título principal
        document.querySelector('h1').textContent = videojuego.title;
        
        // Rellenamos el precio
        document.querySelector('.preu').textContent = `${parseFloat(videojuego.price).toFixed(2)}€`;
        
        // Rellenamos la descripción (dentro de la pestaña)
        const elementoDescripcion = document.querySelector('.tab-content p');
        if (elementoDescripcion) {
            elementoDescripcion.textContent = videojuego.description;
        }
        
        // Actualizamos la ruta de navegación (breadcrumb)
        // Usamos un selector específico para no afectar los enlaces del header
        const elementosRuta = document.querySelectorAll('main nav ul li a');
        
        // Actualizamos la plataforma en la ruta
        if (elementosRuta[1]) {
            elementosRuta[1].textContent = videojuego.platform_name;
        }
        
        // Actualizamos la categoría en la ruta
        if (elementosRuta[2]) {
            elementosRuta[2].textContent = videojuego.category_name;
        }
        
        // Actualizamos el último elemento de la ruta (nombre del juego)
        const ultimoElementoRuta = document.querySelector('main nav ul li:last-child');
        if (ultimoElementoRuta) {
            ultimoElementoRuta.textContent = videojuego.title;
        }
        
        // Actualizamos el stock disponible (opcional)
        // Si tienes un elemento para mostrarlo, puedes añadir:
        // document.querySelector('.stock').textContent = `Stock: ${videojuego.stock}`;
        
    } catch (error) {
        console.error('Error al cargar el detalle:', error);
        alert('No se ha podido cargar el videojuego');
    }
}

// Cuando la página esté cargada, ejecutamos la función
document.addEventListener('DOMContentLoaded', cargarDetalle);