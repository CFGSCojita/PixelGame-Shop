// Función para cargar videojuegos desde la API
async function cargarVideojuegos(pagina = 1) {
    // Estructura 'try-catch'.
    // Intentará obtener la respuesta de la API y crear las tarjetas. En caso de que haya algún error, lo capturará.
    try {
        // Llamada al endpoint de la API
        const respuesta = await fetch(`backend/endpoints/get_videogames.php?pagina=${pagina}`); // Incluimos el parámetro de página.
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
    const contenedor = document.querySelector('.paginacio'); // Obtenemos el contenedor de la paginación.
    if (!contenedor) return; // Si no existe el contenedor, salimos de la función.

    contenedor.innerHTML = ''; // Limpiamos la paginación.

    // Bucle 'for'.
    // Iterará desde 1 hasta el total de páginas para crear los botones.
    for (let i = 1; i <= total; i++) {
        const boton = document.createElement('a'); // Creamos un elemento 'a' para cada botón.
        boton.href = '#'; // Asignamos el href.
        boton.textContent = i; // Asignamos el número de página como texto.
        boton.className = i === actual ? 'btn-pagina activo' : 'btn-pagina'; // Asignamos la clase CSS, resaltando el botón activo.
        
        // Creamos un evento 'click' para cada botón.
        boton.addEventListener('click', (e) => {
            e.preventDefault(); // Prevenimos el comportamiento por defecto del enlace.
            cargarVideojuegos(i); // Cargamos los videojuegos de la página correspondiente.
        });

        contenedor.appendChild(boton); // Añadimos el botón al contenedor.
    }
}

// Cargamos los videojuegos cuando la página esté lista con document.
document.addEventListener('DOMContentLoaded', () => {
    cargarVideojuegos(1); // Página 1 por defecto.
});