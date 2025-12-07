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
    const contenedor = document.getElementById("resultado-busqueda");
    
    // Estructura de control 'if'.
    // Si no hay resultados, mostramos un mensaje.
    if (videojuegos.length === 0) {
        contenedor.innerHTML = "<p style='color: #FF3366;'>No se encontraron resultados</p>";
        return;
    }
    
    // Limpiamos el contenedor antes de añadir nuevos resultados.
    contenedor.innerHTML = "";
    
    // Bucle 'forEach'.
    // Recorremos cada videojuego encontrado y creamos su elemento HTML.
    videojuegos.forEach(juego => {
        const div = document.createElement('div');
        div.style.cssText = 'padding: 10px; border: 1px solid #2A2A2A; margin: 5px 0; background-color: #1A1A1A; border-radius: 4px;';
        
        div.innerHTML = `
            <strong style="color: #FCFCFC;">${juego.title}</strong><br>
            <span style="color: #E6E6E6; font-size: 0.9rem;">
                ${juego.category_name} | ${juego.platform_name} | ${juego.price}€
            </span>
        `;
        
        contenedor.appendChild(div);
    });
}