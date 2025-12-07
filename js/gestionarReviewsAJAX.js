// Para el formulario de insertar review con AJAX
document.querySelectorAll('form[action*="db_review_insert.php"]').forEach(form => {
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
                alert('Review añadida correctamente');
                window.location.href = '/student006/shop/backend/php/orders.php'; // Redirigimos a orders.php
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Para el formulario de actualizar review con AJAX
document.querySelectorAll('form[action*="db_review_update.php"]').forEach(form => {
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
                alert('Review actualizada correctamente');
                location.reload(); // Recargamos la página para ver los cambios.
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Formulario de eliminar review con AJAX
document.querySelectorAll('form[action*="db_review_delete.php"]').forEach(form => {
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
                alert('Review eliminada correctamente');
                location.reload(); // Recargamos la página para ver los cambios.
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});