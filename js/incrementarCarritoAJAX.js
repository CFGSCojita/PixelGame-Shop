// Buscamos todos los formularios de incrementar cantidad y les añadimos un listener para manejar el envío mediante fetch.
document.querySelectorAll('form[action*="db_cart_incrementar.php"]').forEach(form => {
    // Añadimos un listener cuando se pulse el botón "+"
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