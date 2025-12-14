// Formulario de insertar usuario con AJAX
document.querySelectorAll('form[action*="db_user_insert.php"]').forEach(form => {
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
                alert('Usuario añadido correctamente');
                window.location.href = '/student006/shop/backend/php/users.php'; // Redirigimos a users.php
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Formulario de actualizar usuario con AJAX
document.querySelectorAll('form[action*="db_user_update.php"]').forEach(form => {
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
                alert('Usuario actualizado correctamente');
                window.location.href = '/student006/shop/backend/php/users.php'; // Redirigimos a users.php
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

// Formulario de eliminar usuario con AJAX
document.querySelectorAll('form[action*="db_user_delete.php"]').forEach(form => {
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
                alert('Usuario eliminado correctamente');
                location.reload(); // Recargamos la página para ver los cambios.
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});