// Buscamos todos los formularios de añadir al carrito y les añadimos un listener para manejar el envío mediante fetch.
// Por cada formulario encontrado, prevenimos el envío por defecto y usamos fetch para enviar los datos.
document.querySelectorAll('form[action*="db_cart_insert.php"]').forEach(form => {
    // Añadimos un listener cuando se pulse el botón de añadir al carrito
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Enviamos los datos en segundo plano usando fetch API.
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json()) // Convertimos la respuesta a JSON.

        // Actualizamos el contador del carrito en la interfaz.
        .then(data => {
            document.querySelector('.badge').textContent = data.cart_count;
        });
    });
});