<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect_localhost.php');
?>

<!DOCTYPE html>
<html>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/header.php');
    ?>

    <main class="container my-5">
        <!-- Título principal -->
        <h1 class="text-center mb-5" style="color: #FCFCFC; font-weight: 700;">Panel de Administración</h1>
        
        <!-- Botones principales -->
        <div class="row justify-content-center g-4">
            
            <!-- Botón Videojuegos -->
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/products.php" class="btn-main-option">
                    <i class="bi bi-controller"></i>
                    <h3>Videojuegos</h3>
                    <p>Gestionar catálogo de videojuegos</p>
                </a>
            </div>
            
            <!-- Botón Usuarios -->
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/customers.php" class="btn-main-option">
                    <i class="bi bi-people"></i>
                    <h3>Usuarios</h3>
                    <p>Gestionar usuarios registrados</p>
                </a>
            </div>
            
            <!-- Botón Pedidos -->
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/orders.php" class="btn-main-option">
                    <i class="bi bi-box-seam"></i>
                    <h3>Pedidos</h3>
                    <p>Gestionar pedidos de clientes</p>
                </a>
            </div>
            
        </div>
    </main>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/footer.php'); 
    ?>

</html>