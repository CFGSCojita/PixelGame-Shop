// Buscamos todos los formularios de eliminar del carrito y les añadimos un listener para manejar el envío mediante fetch.
document.querySelectorAll('form[action*="db_cart_delete.php"]').forEach(form => {
    // Añadimos un listener cuando se pulse el botón de eliminar
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Detenemos el envío por defecto del formulario para evitar recargar la página.
        
        // Guardamos referencia al elemento padre (el div del producto)
        const productDiv = this.closest('.cart-item, div[style*="border"]');
        
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
                
                // Eliminamos visualmente el producto del DOM
                if (productDiv) {
                    productDiv.remove();
                }
                
                // Si el carrito está vacío, mostramos mensaje
                const productosRestantes = document.querySelectorAll('form[action*="db_cart_delete.php"]');
                if (productosRestantes.length === 0) {
                    document.querySelector('h1').insertAdjacentHTML('afterend', 
                        '<p>El carrito está vacío.</p>');
                }
            }
        });
    });
});