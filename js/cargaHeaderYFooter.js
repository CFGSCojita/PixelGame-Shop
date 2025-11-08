// Creamos una función asíncrona para cargar componentes HTML
async function cargarElemento(elementId, rutaArchivo) {

    // Estructura 'try-catch'
    // Intentará realizar la carga del archivo HTML y manejará cualquier error que ocurra durante el proceso.
    try {
        const respuesta = await fetch(rutaArchivo); // Realizamos la petición para obtener el archivo HTML.
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

// Añadimos un evento que se ejecuta cuando el contenido del DOM ha sido completamente cargado.
// Es decir, cargaremos el header y footer una vez que la página esté lista.
document.addEventListener('DOMContentLoaded', () => {
    cargarElemento('contenidor-header', 'views/header.html');
    cargarElemento('contenidor-footer', 'views/footer.html');
});