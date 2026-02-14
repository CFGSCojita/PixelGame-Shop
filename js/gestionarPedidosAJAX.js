// Formulario de eliminar pedido con AJAX
document.querySelectorAll('form[action*="db_order_delete.php"]').forEach(form => {
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
                alert('Pedido eliminado correctamente');
                location.reload(); // Recargamos la página para ver los cambios.
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});