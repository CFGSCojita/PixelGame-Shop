
<!-- Llamada a la base de datos. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
?>

<!DOCTYPE html>
<html>

    <!-- Llamada al header. -->
    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/header.php');
    ?>

    <style>

        /* Cada botón de opción en la página. */
        .btnOpcion {
            display: block;
            background-color: #1A1A1A;
            border: 2px solid #2A2A2A;
            border-radius: 8px;
            padding: 3rem 2rem;
            text-align: center;
            text-decoration: none;
            color: #E6E6E6;
            transition: all 0.3s ease;
        }
        
        /* Al pasar el cursor sobre el botón */
        .btnOpcion:hover {
            background-color: #2A2A2A;
            border-color: #FF3366;
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(255, 51, 102, 0.3);
        }
        
        /* Icono dentro del botón */
        .btnOpcion i {
            font-size: 4rem;
            color: #00CCFF;
            margin-bottom: 1rem;
            display: block;
        }
        
        /* Título y descripción dentro del botón */
        .btnOpcion h3 {
            color: #FCFCFC;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        /* Texto dentro del botón */
        .btnOpcion p {
            color: #E6E6E6;
            margin: 0;
            font-size: 0.9rem;
        }
    </style>

    <!-- Contenedor principal con un margen vertical de 5 -->
    <main class="contenedor my-5">

        <!-- Título de la sección aplicando estilos en línea y mostrando color blanco con negrita-->
        <h1 class="text-center mb-5" style="color: #FCFCFC; font-weight: 700;">Opciones</h1>
        
        <!-- Usamos el sistema de rejilla de Bootstrap para crear una fila con columnas centradas y un espacio entre ellas -->
        <div class="row justify-content-center g-4">
    
            <!-- Cada columna ocupa 4 columnas en pantallas medianas y más grandes, y contiene un enlace con la clase btnOpcion que incluye un icono, un título y una descripción. -->
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/videogames.php" class="btnOpcion">
                    <i class="bi bi-controller"></i> <!-- Icono de un controlador de videojuegos usando Bootstrap Icons -->
                    <h3>Videojuegos</h3>
                    <p>Gestionar catálogo de videojuegos</p>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/users.php" class="btnOpcion">
                    <i class="bi bi-people"></i> <!-- Icono de usuarios usando Bootstrap Icons -->
                    <h3>Usuarios</h3>
                    <p>Gestionar usuarios registrados</p>
                </a>
            </div>

            <div class="col-md-4">
                <a href="/student006/shop/backend/php/orders.php" class="btnOpcion">
                    <i class="bi bi-box-seam"></i> <!-- Icono de caja usando Bootstrap Icons -->
                    <h3>Pedidos</h3>
                    <p>Gestionar pedidos de clientes</p>
                </a>
            </div>
            
        </div>
    </main>
    
    <!-- Llamada al footer. -->
    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/footer.php'); 
    ?>

</html>