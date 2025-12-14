<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Recogemos los datos del formulario.
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = $_POST['category_id'];
    $platform_id = $_POST['platform_id']; 
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Declaramos una variable para guardar el nombre de la imagen.
    $image_path = NULL;

    // Estructura de control 'if'.
    // Si se ha subido una imagen, la procesamos.
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        
        // Estructura de control 'if'.
        // Validamos el tamaño (máximo 2MB).
        if ($_FILES['image']['size'] > 2097152) {
            echo json_encode(['success' => false, 'error' => 'La imagen no puede superar 2MB']);
            exit();
        }

        // Validamos el tipo de archivo.
        $extensiones = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['image']['type'], $extensiones)) {
            echo json_encode(['success' => false, 'error' => 'Solo se permiten imágenes JPG, PNG o WEBP']);
            exit();
        }

        // Generamos un nombre único para evitar duplicados.
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_path = uniqid() . '_' . time() . '.' . $extension;

        // Ruta donde se guardará la imagen.
        $upload_dir = $root_DIR . '/student006/shop/assets/img/';
        $upload_file = $upload_dir . $image_path;

        // Estructura de control 'if'.
        // Movemos la imagen desde la ubicación temporal al servidor.
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            echo json_encode(['success' => false, 'error' => 'Error al subir la imagen']);
            exit();
        }
    }

    // Preparamos la consulta SQL (ahora incluye image_path).
    $sql = "INSERT INTO 006_videogames (category_id, platform_id, title, description, image_path, release_date, price, stock) 
            VALUES ('$category_id', '$platform_id', '$title', '$description', '$image_path', '$release_date', '$price', '$stock')";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_query($conn, $sql)) {
        header('Content-Type: application/json'); // Indicamos que la respuesta contendrá un JSON.
        echo json_encode(['success' => true]); // Devolvemos una respuesta JSON indicando éxito.
    } else {
        header('Content-Type: application/json'); // Indicamos que la respuesta contendrá un JSON.
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]); // Devolvemos una respuesta JSON indicando error.
    }

    mysqli_close($conn); // Cerramos la conexión a la base de datos.

    exit();
?>