<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<link rel="stylesheet" href="/student006/shop/css/estadisticas-php.css">

<div class="contenedor-estadisticas">

    <h1>📊 Estadísticas de Ventas</h1>
    <hr>

    <!-- Pedidos por Mes -->
    <div class="grafico-contenedor">
        <h2>Pedidos por Mes</h2>
        <canvas id="graficoPorMes"></canvas>
    </div>

    <!-- Pedidos por Cliente -->
    <div class="grafico-contenedor">
        <h2>Pedidos por Cliente</h2>
        <canvas id="graficoPorCliente"></canvas>
    </div>

    <!-- Pedidos por Producto -->
    <div class="grafico-contenedor">
        <h2>Pedidos por Producto</h2>
        <canvas id="graficoPorProducto"></canvas>
    </div>

    <div class="boton-volver">
        <a href="/student006/shop/backend/php/videogames.php" class="btn-volver">← Volver a Videojuegos</a>
    </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Declaramos una variable con las opciones comunes para todos los gráficos, para evitar repetir código.
    const opcionesComunes = {
        responsive: true, // El gráfico se adapta al tamaño del contenedor.
        maintainAspectRatio: false, // Permitimos que el gráfico ocupe todo el espacio disponible.
        // Escalas y estilos para mejorar la apariencia del gráfico:
        scales: {
            y: { beginAtZero: true, ticks: { color: '#E6E6E6' }, grid: { color: '#2A2A2A' } }, // Eje Y con ticks y grid personalizados.
            x: { ticks: { color: '#E6E6E6' }, grid: { color: '#2A2A2A' } } // Eje X con ticks y grid personalizados.
        },
        // Estilos para la leyenda del gráfico:
        plugins: {
            legend: { labels: { color: '#FCFCFC', font: { size: 14 } } }
        }
    };

    // Creamos una función para generar un gráfico de barras, recibiendo el id del canvas, las etiquetas, los datos y la etiqueta del dataset:
    function crearGrafico(id, labels, data, label) {
        // Usamos Chart.js para crear un gráfico de barras en el canvas con el id especificado, utilizando las etiquetas, datos y opciones comunes:
        new Chart(document.getElementById(id), {
            type: 'bar', // Tipo de gráfico: barras.
            // Data para el gráfico, con las etiquetas y el dataset:
            data: {
                labels: labels,
                // Configuración del dataset, con colores personalizados para las barras y bordes:
                datasets: [{ label, data, backgroundColor: '#00CCFF', borderColor: '#FF3366', borderWidth: 2, maxBarThickness: 80 }]
            },
            options: opcionesComunes // Aquí aplicamos las opciones comunes que definimos antes para mantener un estilo consistente en todos los gráficos.
        });
    }

    // Realizamos un fetch al endpoint que devuelve las estadísticas en formato JSON, y luego creamos los gráficos con los datos recibidos:
    fetch('/student006/shop/backend/endpoints/get_estadisticas.php')
        .then(r => r.json()) // Convertimos la respuesta a JSON.

        // Con los datos recibidos, llamamos a la función crearGrafico para cada tipo de estadística, pasando las etiquetas y datos correspondientes:
        .then(datos => {
            crearGrafico('graficoPorMes',      datos.por_mes.map(d => d.mes),      datos.por_mes.map(d => d.total_pedidos),      'Pedidos');
            crearGrafico('graficoPorCliente',  datos.por_cliente.map(d => d.cliente),  datos.por_cliente.map(d => d.total_pedidos),  'Pedidos');
            crearGrafico('graficoPorProducto', datos.por_producto.map(d => d.producto), datos.por_producto.map(d => d.total_pedidos), 'Pedidos');
        })
        .catch(err => console.error('Error:', err));
</script>

<?php require($root_DIR . '/student006/shop/backend/php/footer.php'); ?>