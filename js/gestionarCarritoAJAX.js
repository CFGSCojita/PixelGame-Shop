// Formulario de añadir al carrito con AJAX
document.querySelectorAll('form[action*="db_cart_insert.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Enviamos los datos en segundo plano usando fetch API.
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json()) // Convertimos la respuesta a JSON.
        .then(data => {
            // Actualizamos el contador del carrito en la interfaz.
            document.querySelector('.badge').textContent = data.cart_count;
        });
    });
});

// Formulario de eliminar del carrito con AJAX
document.querySelectorAll('form[action*="db_cart_delete.php"]').forEach(form => {
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
                // Actualizamos el contador del carrito en la interfaz.
                document.querySelector('.badge').textContent = data.cart_count;
                
                // Recargamos la página para ver los cambios en la tabla
                location.reload();
            }
        });
    });
});

// Formulario de incrementar cantidad con AJAX
document.querySelectorAll('form[action*="db_cart_incrementar.php"]').forEach(form => {
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
                // Actualizamos el contador del carrito en la interfaz.
                document.querySelector('.badge').textContent = data.cart_count;
                
                // Recargamos la página para ver los cambios en la tabla
                location.reload();
            }
        });
    });
});

// Formulario de decrementar cantidad con AJAX
document.querySelectorAll('form[action*="db_cart_decrementar.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch(this.action, { method: 'POST', body: new FormData(this) })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.badge').textContent = data.cart_count;
                location.reload();
            }
        });
    });
});