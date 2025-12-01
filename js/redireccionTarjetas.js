// Script para hacer clickables las tarjetas de productos
// Si el usuario pulsa en la tarjeta (excepto en el botón), redirige a la página de detalle
document.querySelectorAll('.tarjeta-producte').forEach(card => {
    card.style.cursor = 'pointer'; // Cursor de mano para indicar que es clickable
    
    card.addEventListener('click', (e) => {
        // Si NO han pulsado el botón "Añadir al Carrito", redirigir
        if (!e.target.classList.contains('btn-afegir')) {
            window.location.href = 'views/product-detail.html';
        }
    });
});

// Script para hacer clickables las tarjetas de destacados (hero)
// Mismo funcionamiento que las tarjetas normales
document.querySelectorAll('.tarjeta-hero').forEach(card => {
    card.style.cursor = 'pointer';
    
    card.addEventListener('click', (e) => {
        // Si NO han pulsado el botón "Ver Detalles", redirigir
        if (!e.target.classList.contains('btn-detalls')) {
            window.location.href = 'views/product-detail.html';
        }
    });
});