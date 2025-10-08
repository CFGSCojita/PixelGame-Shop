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

        <h1 class="text-center mb-5" style="color: #FCFCFC; font-weight: 700;">Opciones</h1>
        
        <div class="row justify-content-center g-4">
            >
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/products.php" class="btn-main-option">
                    <i class="bi bi-controller"></i>
                    <h3>Videojuegos</h3>
                    <p>Gestionar catálogo de videojuegos</p>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="/student006/shop/backend/php/customers.php" class="btn-main-option">
                    <i class="bi bi-people"></i>
                    <h3>Usuarios</h3>
                    <p>Gestionar usuarios registrados</p>
                </a>
            </div>

            <div class="col-md-4">
                <a href="/student006/shop/backend/php/orders.php" class="btn-main-option">
                    <i class="bi bi-box-seam"></i>
                    <h3>Pedidos</h3>
                    <p>Gestionar pedidos de clientes</p>
                </a>
            </div>
            
        </div>
    </main>

    <style>

        .btn-main-option {
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
        
        .btn-main-option:hover {
            background-color: #2A2A2A;
            border-color: #FF3366;
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(255, 51, 102, 0.3);
        }
        
        .btn-main-option i {
            font-size: 4rem;
            color: #00CCFF;
            margin-bottom: 1rem;
            display: block;
        }
        
        .btn-main-option h3 {
            color: #FCFCFC;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .btn-main-option p {
            color: #E6E6E6;
            margin: 0;
            font-size: 0.9rem;
        }
    </style>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/footer.php'); 
    ?>

</html>