// Creamos una función asíncrona para cargar componentes HTML
async function cargarElemento(elementId, rutaArchivo) {

    // Estructura 'try-catch'
    // Intentará realizar la carga del archivo HTML y manejará cualquier error que ocurra durante el proceso.
    try {
        const respuesta = await fetch(rutaArchivo); // Realizamos la petición para obtener el archivo HTML.
        
        // Verificamos si la respuesta fue exitosa
        if (!respuesta.ok) {
            console.error(`Error ${respuesta.status}: No se pudo cargar ${rutaArchivo}`);
            return;
        }
        
        const html = await respuesta.text(); // Convertimos la respuesta a texto.
        document.getElementById(elementId).innerHTML = html; // Insertamos el HTML en el contenedor correspondiente.

        // Estructura de control 'if'.
        // Sí el objeto 'lucide' (es decir, la librería de iconos) está definido, llamamos a la función 'createIcons()' para inicializar los iconos.
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    } catch (e) {
        console.error(`Error cargando ${rutaArchivo}:`, e);
    }
}

// Función para inicializar el menú desplegable
function inicializarMenu() {
    const menuButton = document.querySelector('.menu-desplegable');
    const navMenu = document.querySelector('.nav-menu');

    // Estructura de control 'if'
    // Verificamos que los elementos existan antes de añadir el evento
    if (menuButton && navMenu) {
        menuButton.addEventListener('click', () => {
            // Alternamos la clase 'active' para mostrar/ocultar el menú
            navMenu.classList.toggle('active');
        });
    }
}

// Función para inicializar el buscador móvil
function inicializarBuscadorMobil() {
    const iconoCerca = document.querySelector('.icona-cerca-mobil');
    const buscadorMobil = document.querySelector('.buscador-mobil');
    const tancarCerca = document.querySelector('.tancar-cerca');

    // Estructura de control 'if'
    // Verificamos que los elementos existan
    if (iconoCerca && buscadorMobil && tancarCerca) {
        // Abrir buscador
        iconoCerca.addEventListener('click', () => {
            buscadorMobil.classList.add('active');
            // Enfocamos el input automáticamente
            const input = buscadorMobil.querySelector('input');
            if (input) {
                input.focus();
            }
        });

        // Cerrar buscador
        tancarCerca.addEventListener('click', () => {
            buscadorMobil.classList.remove('active');
        });
    }
}

// Añadimos un evento que se ejecuta cuando el contenido del DOM ha sido completamente cargado.
// Es decir, cargaremos el header y footer una vez que la página esté lista.
document.addEventListener('DOMContentLoaded', async () => {
    // RUTAS ABSOLUTAS - funcionan desde cualquier archivo
    await cargarElemento('contenidor-header', '/student006/shop/views/header.html');
    await cargarElemento('contenidor-footer', '/student006/shop/views/footer.html');
    
    // Inicializamos el menú y el buscador después de cargar el header
    inicializarMenu();
    inicializarBuscadorMobil();
});