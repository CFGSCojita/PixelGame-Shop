// Formulario de insertar videojuego con AJAX
document.querySelectorAll('form[action*="db_videogame_insert.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Enviamos los datos en segundo plano usando fetch API.
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json()) // Convertimos la respuesta a JSON.
        .then(data => {
            if (data.success) {
                alert('Videojuego añadido correctamente');
                window.location.href = '/student006/shop/backend/php/videogames.php'; // Redirigimos a videogames.php
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Formulario de actualizar videojuego con AJAX
document.querySelectorAll('form[action*="db_videogame_update.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Enviamos los datos en segundo plano usando fetch API.
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json()) // Convertimos la respuesta a JSON.
        .then(data => {
            if (data.success) {
                alert('Videojuego actualizado correctamente');
                window.location.href = '/student006/shop/backend/php/videogames.php'; // Redirigimos a videogames.php
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Formulario de eliminar videojuego con AJAX
document.querySelectorAll('form[action*="db_videogame_delete.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Enviamos los datos en segundo plano usando fetch API.
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json()) // Convertimos la respuesta a JSON.
        .then(data => {
            if (data.success) {
                alert('Videojuego eliminado correctamente');
                location.reload(); // Recargamos la página para ver los cambios.
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});