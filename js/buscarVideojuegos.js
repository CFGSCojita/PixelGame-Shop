// Función para filtrar videojuegos según el texto introducido
function filtrarVideojuegos(texto) {
    // Estructura de control 'if'.
    // Si el campo está vacío, mostramos la lista original y limpiamos resultados.
    if (texto.length == 0) {
        document.getElementById("resultado-busqueda").innerHTML = "";
        // Mostramos toda la lista original de videojuegos
        mostrarListaCompleta(true);
        return;
    } else {
        // Ocultamos la lista original mientras buscamos
        mostrarListaCompleta(false);
        
        // Creamos una nueva petición XMLHttpRequest.
        var xmlhttp = new XMLHttpRequest();
        
        // Definimos qué hacer cuando cambie el estado de la petición.
        xmlhttp.onreadystatechange = function() {
            // Estructura de control 'if'.
            // Si la petición se completó correctamente (readyState == 4 y status == 200).
            if (this.readyState == 4 && this.status == 200) {
                // Parseamos la respuesta JSON que nos devuelve el servidor.
                const videojuegos = JSON.parse(this.responseText);
                
                // Llamamos a la función para mostrar los resultados en la interfaz.
                mostrarResultados(videojuegos);
            }
        };
        
        // Abrimos la petición GET al endpoint, pasando el texto como parámetro.
        xmlhttp.open("GET", "/student006/shop/backend/endpoints/search_videogames.php?texto=" + texto, true);
        
        // Enviamos la petición.
        xmlhttp.send();
    }
}

// Función para mostrar u ocultar la lista completa de videojuegos
function mostrarListaCompleta(mostrar) {
    // Obtenemos solo los divs de videojuegos y los <hr>
    const entries = document.querySelectorAll('.videogame-entry');
    const hrs = document.querySelectorAll('hr');
    
    // Bucle 'forEach'.
    // Recorremos cada elemento y lo mostramos u ocultamos según el parámetro.
    entries.forEach(entry => {
        entry.style.display = mostrar ? 'flex' : 'none';
    });
    
    hrs.forEach(hr => {
        hr.style.display = mostrar ? '' : 'none';
    });
}

// Función para mostrar los resultados de la búsqueda
function mostrarResultados(videojuegos) {
    const contenedor = document.getElementById("resultado-busqueda"); // Guardamos el contenedor donde mostraremos los resultados en una variable.
    
    // Estructura de control 'if'.
    // Si no hay resultados, mostramos un mensaje.
    if (videojuegos.length === 0) {
        contenedor.innerHTML = "<p style='color: #FF3366;'>No se encontraron resultados</p>";
        return;
    }
    
    contenedor.innerHTML = ""; // Limpiamos el contenedor antes de añadir nuevos resultados.
    
    // Bucle 'forEach'.
    // Recorremos cada videojuego y creamos su entrada en el contenedor.
    videojuegos.forEach(game => {
        const div = document.createElement('div'); // Creamos un nuevo div para cada videojuego.
        div.className = 'videogame-entry'; // Asignamos la clase CSS.
        div.style.cursor = 'pointer'; // Cambiamos el cursor para indicar que es clicable.
        
        let imagenHTML; // Variable para almacenar el HTML de la imagen o placeholder.

        // Estructura de control 'if'.
        // Comprobamos si el videojuego tiene una imagen asociada.
        if (game.image_path) {
            imagenHTML = `<img src="/student006/shop/assets/img/${game.image_path}" 
                            alt="${game.title}" 
                            class="videogame-image">`;
        } else {
            imagenHTML = `<span class="videogame-image-placeholder">🎮</span>`;
        }
        
        // Rellenamos el contenido del div con la información del videojuego.
        div.innerHTML = `
            ${imagenHTML}
            <div class="videogame-details">
                <h3>${game.title}</h3>
                <p>${parseFloat(game.price).toFixed(2)} €</p>
                <p class="info-secundaria">
                    Categoría: ${game.category_name} | Plataforma: ${game.platform_name}
                </p>
            </div>
        `;
        
        // Click para ir al detalle
        div.addEventListener('click', () => {
            window.location.href = `/student006/shop/views/product-detail.html?id=${game.videogame_id}`;
        });
        
        contenedor.appendChild(div); // Añadimos el div al contenedor de resultados.
    });
}