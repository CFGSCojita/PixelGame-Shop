<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/header.php');
?>

<!-- CSS específico del manual de usuario -->
<link rel="stylesheet" href="/student006/shop/css/manual_usuario-php.css">

<div class="contenedor-manual">
    
    <h1>Manual de Usuario</h1>

    <div class="contenedor-descarga">
        <a href="/student006/shop/assets/docs/manual_usuario.pdf" download="Manual_Usuario_PixelGame_Shop.pdf" class="btn-descarga">
            <i data-lucide="download" class="icono-descarga"></i>
            Descargar Manual de Usuario (PDF)
        </a>
    </div>

</div>

<!-- Script de Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    require($root_DIR . '/student006/shop/backend/php/footer.php');
?>