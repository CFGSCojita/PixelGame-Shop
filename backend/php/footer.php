</div>

<footer class="py-4" style="background-color: #1A1A1A; border-top: 2px solid #2A2A2A;">
    <div class="container">
        <!-- Footer izquierda con clima -->
        <div class="footer-weather" style="margin-bottom: 15px;">
            <button id="btnWeather" class="btn-weather">API Weather</button>
            <span id="weatherForecast" class="weather-display"></span>
        </div>
        
        <!-- Copyright centrado -->
        <p class="text-center m-0" style="color: #E6E6E6;">
            PixelGame Shop - Copyright © 2025 by Stefan Cojita (Project DIW-DWEC-DWES)
        </p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Añadimos el evento al botón para obtener el clima
    document.getElementById('btnWeather').addEventListener('click', async () => {
        try {
            const response = await fetch('/student006/shop/backend/api/weather.php'); // Obtenemos una respuesta con fetch.
            const data = await response.json(); // Parseamos la respuesta como JSON.
            
            const historico = data.historico; // Obtenemos el array histórico del clima
            
            // Estructura de control 'if'.
            // Si no hay datos históricos, mostramos un mensaje.
            if (historico.length === 0) {
                document.getElementById('weatherForecast').innerHTML = ' No hay datos';
                return;
            }
            
            // Creamos una variable con los iconos para las condiciones climáticas.
            const iconos = {
                'Soleado': '☀️',
                'Despejado': '☀️',
                'Nublado': '☁️',
                'Parcialmente nublado': '⛅',
                'Lluvia': '🌧️',
                'Tormenta': '⛈️',
                'Nieve': '❄️'
            };
            
            // Generamos el HTML para mostrar el clima. Mapeamos el array histórico.
            const html = historico.map((dia, index) => {
                const label = index === 0 ? 'Hoy' : 
                            index === 1 ? 'Ayer' : 
                            index === 2 ? 'Anteayer' : 
                            dia.fecha;
                const icono = iconos[dia.condicion] || '🌤️';
                return `${icono} ${label}: ${dia.temperatura}°C`;
            }).join(' | '); // Unimos los elementos con un separador.
            
            document.getElementById('weatherForecast').innerHTML = ' ' + html; // Mostramos el HTML generado.
        
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('weatherForecast').innerHTML = ' Error al cargar';
        }
    });
</script>

</body>
</html>