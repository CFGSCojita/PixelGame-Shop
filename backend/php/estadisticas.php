<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico de estadísticas -->
<link rel="stylesheet" href="/student006/shop/css/estadisticas-php.css">

<div class="contenedor-estadisticas">
    
    <h1>📊 Estadísticas de Ventas</h1>
    
    <hr>
    
    <!-- Contenedor del gráfico -->
    <div class="grafico-contenedor">
        <h2>Top 5 Videojuegos Más Vendidos</h2>
        <canvas id="graficoTopVideojuegos"></canvas>
    </div>
    
    <!-- Botón para volver -->
    <div class="boton-volver">
        <a href="/student006/shop/backend/php/videogames.php" class="btn-volver">
            ← Volver a Videojuegos
        </a>
    </div>

</div>

<!-- Chart.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script para cargar datos y renderizar gráfico -->
<script>
    // Hacemos fetch al endpoint que devuelve los datos en JSON:
    fetch('/student006/shop/backend/endpoints/get_top_videogames.php')
        .then(response => response.json())
        .then(datos => {
            
            // Separamos los títulos y las ventas en arrays:
            const titulos = datos.map(item => item.title);
            const ventas = datos.map(item => item.ventas);
            
            const ctx = document.getElementById('graficoTopVideojuegos').getContext('2d'); // Obtenemos el contexto del canvas
            
            new Chart(ctx, {
                type: 'bar', // Tipo: gráfico de barras.
                data: {
                    labels: titulos, // Etiquetas del eje X (nombres de juegos).
                    datasets: [{
                        label: 'Cantidad de Ventas',
                        data: ventas, // Datos del eje Y (número de ventas).
                        backgroundColor: '#00CCFF', // Color cyan.
                        borderColor: '#FF3366', // Borde rosa.
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true, // Comenzar desde 0.
                            ticks: {
                                stepSize: 1, // Incrementos de 1 en 1.
                                color: '#E6E6E6' // Color del texto.
                            },
                            grid: {
                                color: '#2A2A2A' // Color de las líneas de la cuadrícula.
                            }
                        },
                        x: {
                            ticks: {
                                color: '#E6E6E6'
                            },
                            grid: {
                                color: '#2A2A2A'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#FCFCFC', // Color del texto de la leyenda.
                                font: {
                                    size: 14
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error al cargar datos:', error);
        });
</script>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>