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
        <h1 class="text-center mb-5" style="color: #FCFCFC; font-weight: 700;">Videojuegos</h1>
        
        <!-- Menú de opciones -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group">
                    
                    <!-- Opción: Insertar Videojuego -->
                    <a href="/student006/shop/backend/forms/form_product_insert.php" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                       style="background-color: #1A1A1A; border: 1px solid #2A2A2A; color: #E6E6E6;">
                        <span><i class="bi bi-plus-circle me-2" style="color: #00CCFF;"></i> Insertar Videojuego</span>
                        <i class="bi bi-chevron-right" style="color: #FF3366;"></i>
                    </a>
                    
                    <!-- Opción: Listar Videojuegos -->
                    <a href="/student006/shop/backend/forms/form_product_select.php" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                       style="background-color: #1A1A1A; border: 1px solid #2A2A2A; color: #E6E6E6;">
                        <span><i class="bi bi-list-ul me-2" style="color: #00CCFF;"></i> Listar Videojuegos</span>
                        <i class="bi bi-chevron-right" style="color: #FF3366;"></i>
                    </a>
                    
                    <!-- Opción: Actualizar Videojuego -->
                    <a href="/student006/shop/backend/forms/form_product_update_call.php" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                       style="background-color: #1A1A1A; border: 1px solid #2A2A2A; color: #E6E6E6;">
                        <span><i class="bi bi-pencil-square me-2" style="color: #00CCFF;"></i> Actualizar Videojuego</span>
                        <i class="bi bi-chevron-right" style="color: #FF3366;"></i>
                    </a>
                    
                    <!-- Opción: Eliminar Videojuego -->
                    <a href="/student006/shop/backend/forms/form_product_delete_call.php" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                       style="background-color: #1A1A1A; border: 1px solid #2A2A2A; color: #E6E6E6;">
                        <span><i class="bi bi-trash me-2" style="color: #00CCFF;"></i> Eliminar Videojuego</span>
                        <i class="bi bi-chevron-right" style="color: #FF3366;"></i>
                    </a>
                    
                </div>
            </div>
        </div>
        
        <!-- Botón para volver al panel principal -->
        <div class="text-center mt-4">
            <a href="/student006/shop/backend/php/index.php" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i> Volver al Panel Principal
            </a>
        </div>
    </main>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/footer.php'); 
    ?>

</html>