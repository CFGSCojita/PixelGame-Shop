// Determinamos si estamos en entorno local o remoto
const esLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

// Definimos la URL base de la API según el entorno
const API_BASE_URL = esLocal
    ? '/student006/shop/backend/endpoints/' 
    : 'https://remotehost.es/student006/shop/backend/endpoints/';

// Obtenemos el parámetro 'id' de la URL
const parametrosURL = new URLSearchParams(window.location.search);
const idVideojuego = parametrosURL.get('id');

// Variable global para almacenar los datos del videojuego actual
let videojuegoActual = null;

// Función para cargar los detalles del videojuego
async function cargarDetalle() {
    try {
        // Hacemos la petición al endpoint con el ID del videojuego
        const respuesta = await fetch(`${API_BASE_URL}get_videogame_detail.php?id=${idVideojuego}`);
        const videojuego = await respuesta.json();
        
        // Guardamos los datos del videojuego en la variable global
        videojuegoActual = videojuego;
        
        // Rellenamos el título principal
        document.querySelector('h1').textContent = videojuego.title;
        
        const contenedorImagen = document.querySelector('.imatge-principal'); // Obtenemos el contenedor de la imagen principal en una variable.
        
        // Estructura de control 'if'
        // Si existe el contenedor de imagen, procedemos a mostrar la imagen
        if (contenedorImagen) {
            // Limpiamos el contenido actual
            contenedorImagen.innerHTML = '';
            
            // Estructura de control 'if-else'
            // Si el videojuego tiene imagen, la mostramos. Si no, mostramos un placeholder.
            if (videojuego.image_path) {
                const img = document.createElement('img');
                img.src = `/student006/shop/assets/img/${videojuego.image_path}`;
                img.alt = videojuego.title;
                img.className = 'w-full h-full object-cover rounded';
                contenedorImagen.appendChild(img);
            } else {
                // Mostramos placeholder si no hay imagen
                contenedorImagen.innerHTML = '<i class="w-20 h-20 text-gray-400" data-lucide="image"></i>';
                
                // Reinicializamos los iconos de Lucide
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }
        
        // Rellenamos el precio
        document.querySelector('.preu').textContent = `${parseFloat(videojuego.price).toFixed(2)}€`;
        
        // Rellenamos la descripción
        const elementoDescripcion = document.querySelector('.contingut-tab p');
        if (elementoDescripcion) {
            elementoDescripcion.textContent = videojuego.description;
        }
        
        // Actualizamos la ruta de navegación (breadcrumb)
        const elementosRuta = document.querySelectorAll('main nav ul li a');
        
        if (elementosRuta[1]) {
            elementosRuta[1].textContent = videojuego.platform_name;
        }
        
        if (elementosRuta[2]) {
            elementosRuta[2].textContent = videojuego.category_name;
        }
        
        const ultimoElementoRuta = document.querySelector('main nav ul li:last-child');
        if (ultimoElementoRuta) {
            ultimoElementoRuta.textContent = videojuego.title;
        }
        
        // Configuramos los botones de cantidad
        configurarBotonesCantidad();
        
        // Configuramos el botón "Añadir al Carrito"
        configurarBotonAñadir();
        
    } catch (error) {
        console.error('Error al cargar el detalle:', error);
        alert('No se ha podido cargar el videojuego');
    }
}

// Creamos la función para configurar el botón "Añadir al Carrito".
function configurarBotonAñadir() {
    const botonAñadir = document.querySelector('.btn-afegir'); // Obtenemos el botón "Añadir al Carrito".
    
    // Estructura de control 'if'
    // Si no existe el botón, salimos de la función
    if (!botonAñadir) {
        console.error('No se encontró el botón "Añadir al Carrito"');
        return;
    }
    
    // Añadimos el evento click al botón
    botonAñadir.addEventListener('click', () => {
        // Estructura de control 'if'
        // Verificamos que tenemos los datos del videojuego
        if (!videojuegoActual) {
            alert('Error: No se han cargado los datos del producto');
            return;
        }
        
        // Obtenemos la cantidad seleccionada
        const cantidadElemento = document.querySelector('.text-xl.font-semibold');
        const cantidad = cantidadElemento ? parseInt(cantidadElemento.textContent) : 1;
        
        // Creamos el objeto producto
        const producto = {
            id: videojuegoActual.videogame_id,
            title: videojuegoActual.title,
            price: videojuegoActual.price,
            platform: videojuegoActual.platform_name,
            image: videojuegoActual.image_path || null
        };
        
        // Añadimos el producto al carrito la cantidad de veces indicada
        for (let i = 0; i < cantidad; i++) {
            CarritoManager.añadirProducto(producto);
        }
        
        const textoOriginal = botonAñadir.textContent; // Guardamos el texto original del botón.
        botonAñadir.textContent = `¡${cantidad > 1 ? cantidad + ' añadidos' : 'Añadido'}! ✓`; // Cambiamos el texto del botón para indicar que se ha añadido.
        botonAñadir.style.backgroundColor = '#00CCFF'; // Cambiamos el color de fondo para indicar éxito.
        
        // Volvemos al estado original después de 1.5 segundos
        setTimeout(() => {
            botonAñadir.textContent = textoOriginal;
            botonAñadir.style.backgroundColor = '';
        }, 1500);
    });
}

// Creamos la función para configurar los botones de cantidad.
function configurarBotonesCantidad() {

    // Obtenemos la sección que contiene los botones de cantidad.
    const seccionCantidad = Array.from(document.querySelectorAll('p')) // Obtenemos todos los párrafos.
        .find(p => p.textContent.trim() === 'Cantidad')?.parentElement; // Buscamos el párrafo con el texto 'Cantidad' y obtenemos su elemento padre.
    
    // Estructura de control 'if'
    // Si no encontramos la sección, salimos de la función
    if (!seccionCantidad) {
        console.error('No se encontró la sección de cantidad');
        return;
    }
    
    // Obtenemos los botones y el span de cantidad
    const botones = seccionCantidad.querySelectorAll('.btn-quantitat');
    const spanCantidad = seccionCantidad.querySelector('.text-xl.font-semibold');
    
    // Estructura de control 'if'
    if (botones.length !== 2 || !spanCantidad) {
        console.error('No se encontraron los botones de cantidad');
        return;
    }
    
    const botonMenos = botones[0]; // Botón "-"
    const botonMas = botones[1]; // Botón "+"
    
    // Evento click para el botón "-"
    botonMenos.addEventListener('click', () => {
        let cantidadActual = parseInt(spanCantidad.textContent);
        
        // Estructura de control 'if'
        // No permitimos que la cantidad sea menor a 1
        if (cantidadActual > 1) {
            spanCantidad.textContent = cantidadActual - 1;
        }
    });
    
    // Evento click para el botón "+"
    botonMas.addEventListener('click', () => {
        let cantidadActual = parseInt(spanCantidad.textContent);
        spanCantidad.textContent = cantidadActual + 1;
    });
}

// Ejecutamos la función cuando se carga la página
document.addEventListener('DOMContentLoaded', cargarDetalle);