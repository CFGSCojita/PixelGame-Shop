
// Declaramos el objeto CarritoManager para manejar el carrito de compras.
const CarritoManager = {
    
    STORAGE_KEY: 'pixelgame_carrito', // Clave para guardar el carrito en sessionStorage.

    // Creamos un método para obtener el carrito desde sessionStorage.
    // Devolveremos un array con los productos del carrito.
    // Si no existe, devolveremos un array vacío.
    obtenerCarrito() {
        const carritoJSON = sessionStorage.getItem(this.STORAGE_KEY);
        return carritoJSON ? JSON.parse(carritoJSON) : [];
    },

    // Creamos un método para guardar el carrito en sessionStorage.
    // Recibirá un array de productos y lo guardará como JSON.
    guardarCarrito(carrito) {
        sessionStorage.setItem(this.STORAGE_KEY, JSON.stringify(carrito));
    },

    // Creamos un método para añadir un producto al carrito.
    // Recibiremos un objeto producto con: {id, title, price, platform, image}
    // Si ya existe, incrementaremos la cantidad.
    añadirProducto(producto) {
        let carrito = this.obtenerCarrito();
        
        // Buscamos si el producto ya está en el carrito
        const indiceExistente = carrito.findIndex(item => item.id === producto.id);
        
        // Estructura de control 'if'
        // Si el producto ya existe, incrementamos la cantidad.
        if (indiceExistente !== -1) {
            carrito[indiceExistente].cantidad += 1;
        } else {
            // Si no existe, lo añadimos con cantidad 1:
            carrito.push({
                id: producto.id,
                title: producto.title,
                price: parseFloat(producto.price),
                platform: producto.platform,
                image: producto.image || null,
                cantidad: 1
            });
        }
        
        // Guardamos el carrito actualizado
        this.guardarCarrito(carrito);
        
        // Actualizamos el contador visual
        this.actualizarContador();
        
        return true; // Indicamos que se añadió correctamente devolviendo 'true'.
    },

    // Creamos un método para eliminar un producto del carrito por su ID.
    eliminarProducto(productoId) {
        let carrito = this.obtenerCarrito(); // Obtenemos el carrito actual con el método creado antes.
        
        // Filtramos el carrito para quitar el producto con ese ID
        carrito = carrito.filter(item => item.id !== productoId);
        
        // Guardamos el carrito actualizado
        this.guardarCarrito(carrito);
        
        // Actualizamos el contador visual
        this.actualizarContador();
        
        return true; // Indicamos que se eliminó correctamente devolviendo 'true'.
    },

    // Creamos un método para actualizar la cantidad de un producto en el carrito.
    // Recibiremos el ID y la nueva cantidad.
    actualizarCantidad(productoId, nuevaCantidad) {
        let carrito = this.obtenerCarrito(); // Obtenemos el carrito actual.
        
        // Buscamos el producto en el carrito
        const indice = carrito.findIndex(item => item.id === productoId);
        
        // Estructura de control 'if'
        // Si lo encontramos y la cantidad es válida, actualizamos:
        if (indice !== -1) {
            // Si la cantidad es 0 o menor, eliminamos el producto:
            if (nuevaCantidad <= 0) {
                this.eliminarProducto(productoId);
            } else {
                carrito[indice].cantidad = parseInt(nuevaCantidad);
                this.guardarCarrito(carrito);
                this.actualizarContador();
            }
        }
        
        return true; // Indicamos que se actualizó correctamente devolviendo 'true'.
    },

    // Creamos un método para obtener el total de items en el carrito.
    // Sumaremos todas las cantidades de todos los productos.
    obtenerTotalItems() {
        const carrito = this.obtenerCarrito();
        return carrito.reduce((total, item) => total + item.cantidad, 0);
    },

    // Creamos un método para calcular el total a pagar del carrito.
    // Sumarmemos el precio de todos los productos multiplicado por su cantidad.
    calcularTotal() {
        const carrito = this.obtenerCarrito();
        return carrito.reduce((total, item) => total + (item.price * item.cantidad), 0);
    },

    // Creamos un método para actualizar el contador visual del carrito en la página.
    // Buscaremos el elemento del contador en el HTML y lo actualizaremos.
    actualizarContador() {
        const totalItems = this.obtenerTotalItems(); // Obtenemos el total de items en el carrito.
        const contador = document.querySelector('.cart-count'); // Seleccionamos el elemento del contador en el HTML.
        
        // Estructura de control 'if'
        // Si existe el elemento contador en el HTML, lo actualizamos
        if (contador) {
            contador.textContent = totalItems;
            
            // Si hay productos, mostramos el contador
            // Si no hay productos, lo ocultamos
            if (totalItems > 0) {
                contador.style.display = 'flex';
            } else {
                contador.style.display = 'none';
            }
        }
    },

    // Creamos un método para vaciar el carrito completamente.
    vaciarCarrito() {
        sessionStorage.removeItem(this.STORAGE_KEY); // Eliminamos el carrito del sessionStorage.
        this.actualizarContador(); // Actualizamos el contador visual.
        return true; // Indicamos que se vació correctamente devolviendo 'true'.
    }
};

// Añadimos un evento para actualizar el contador cuando se cargue la página.
// Al cargar la página, actualizamos el contador.
document.addEventListener('DOMContentLoaded', () => {
    CarritoManager.actualizarContador();
});