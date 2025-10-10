
<!-- Llamada a la base de datos y el header a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/header.php');
?>


<h1>Consulta Simple de Videojuegos</h1>

<!-- Formulario para listar todos los videojuegos -->
<form action="/student006/shop/backend/db/db_videogame_select.php" method="POST">
    
    <p>Presiona el botón para listar todos los videojuegos en la base de datos.</p>
    
    <input type="submit" value="Mostrar Videojuegos">
</form>

<!-- Llamada al footer a través del directorio root. -->
<?php
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/php/footer.php');
?>