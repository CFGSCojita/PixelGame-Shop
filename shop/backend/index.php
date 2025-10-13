<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');
?>

<!DOCTYPE html>
<html>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/header.php');
    ?>
    
    <div class="container my-5">
        <h1 class="text-center" style="color: #FCFCFC; font-weight: 700;">Bienvenido al Panel de Administración</h1>
        <p class="text-center mt-3" style="color: #E6E6E6;">Utiliza la barra de navegación superior para gestionar las distintas secciones.</p>
    </div>

    <?php 
        $root_DIR = $_SERVER['DOCUMENT_ROOT'];
        include($root_DIR . '/student006/shop/backend/php/footer.php'); 
    ?>

</html>