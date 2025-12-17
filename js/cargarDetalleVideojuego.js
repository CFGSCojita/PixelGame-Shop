
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

        const contenedorImagen = document.querySelector('.imatge-principal'); // Guardamos el contenedor de la imagen en una variable.

        // Estructura de control 'if'.
        // Si el contenedor de la imagen existe, procedemos a rellenarlo.
        if (contenedorImagen) {
            if (videojuego.image_path) {
                // Si hay imagen, la mostramos
                contenedorImagen.innerHTML = `<img src="/student006/shop/assets/img/${videojuego.image_path}" 
                                                alt="${videojuego.title}" 
                                                class="w-full h-full object-cover rounded">`;
            } else {
                // Si no hay imagen, mostramos el placeholder
                contenedorImagen.innerHTML = `
                    <span style="font-size: 5rem; color: #999;">🎮</span>
                `;
            }
        }
        
        // Rellenamos el precio
        document.querySelector('.preu').textContent = `${parseFloat(videojuego.price).toFixed(2)}€`;
        
        // Rellenamos la descripción (dentro del contenedor de pestañas)
        const elementoDescripcion = document.querySelector('.contingut-tab p');
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
        
        // Configuramos los botones de cantidad
        configurarBotonesCantidad();
        
    } catch (error) {
        console.error('Error al cargar el detalle:', error);
        alert('No se ha podido cargar el videojuego');
    }
}

// Función para manejar los botones de cantidad (+ y -)
function configurarBotonesCantidad() {
    // Buscamos el contenedor de la sección "Cantidad" usando el texto del <p>
    const seccionCantidad = Array.from(document.querySelectorAll('p'))
        .find(p => p.textContent.trim() === 'Cantidad')?.parentElement;
    
    // Estructura de control 'if'.
    // Si no se encuentra la sección, mostramos un error y salimos de la función.
    if (!seccionCantidad) {
        console.error('No se encontró la sección de cantidad');
        return;
    }
    
    // Dentro de esa sección, buscamos el span y los botones
    const cantidadElemento = seccionCantidad.querySelector('span.text-xl');
    const botones = seccionCantidad.querySelectorAll('button');
    
    let cantidad = 1; // Declaramos una variable con la cantidad inicial.
    cantidadElemento.textContent = cantidad; // Inicializamos el contenido del span.
    
    // Botón decrementar (primer botón = índice 0)
    botones[0].addEventListener('click', () => {
        // Estructura de control 'if'.
        // Solo decrementamos si la cantidad es mayor que 1.
        if (cantidad > 1) {
            cantidad--;
            cantidadElemento.textContent = cantidad;
        }
    });
    
    // Botón incrementar (segundo botón = índice 1)
    botones[1].addEventListener('click', () => {
        cantidad++; // Incrementamos la cantidad.
        cantidadElemento.textContent = cantidad; // Actualizamos el contenido del span.
    });
}

// Cuando la página esté cargada, ejecutamos la función
document.addEventListener('DOMContentLoaded', cargarDetalle);