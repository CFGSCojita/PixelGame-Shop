<?php
    // Iniciamos la sesión.
    session_start();

    // Llamada a la base de datos a través del directorio root.
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Recogemos los datos del formulario.
    $videogame_id = $_POST['videogame_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = $_POST['category_id'];
    $platform_id = $_POST['platform_id'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Parte para actualizar imagen.
    $update_image = "";

    // Estructura de control 'if'.
    // Si se ha subido una nueva imagen, la procesamos.
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        
        // Validamos el tamaño (máximo 2MB).
        if ($_FILES['image']['size'] > 2097152) {
            echo json_encode(['success' => false, 'error' => 'La imagen no puede superar 2MB']);
            exit();
        }

        // Validamos el tipo de archivo.
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            echo json_encode(['success' => false, 'error' => 'Solo se permiten imágenes JPG, PNG o WEBP']);
            exit();
        }

        // Obtenemos la imagen antigua para eliminarla.
        $sql_old = "SELECT image_path FROM 006_videogames WHERE videogame_id = $videogame_id";
        $result_old = mysqli_query($conn, $sql_old);
        $old_image = mysqli_fetch_assoc($result_old);
        
        // Si existe imagen antigua, la eliminamos del servidor.
        if (!empty($old_image['image_path'])) {
            $old_file = $root_DIR . '/student006/shop/assets/img/' . $old_image['image_path'];
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        }

        // Generamos un nombre único para la nueva imagen.
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_path = uniqid() . '_' . time() . '.' . $extension;

        // Ruta donde se guardará la imagen.
        $upload_dir = $root_DIR . '/student006/shop/assets/img/';
        $upload_file = $upload_dir . $image_path;

        // Movemos la imagen desde la ubicación temporal al servidor.
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            echo json_encode(['success' => false, 'error' => 'Error al subir la imagen']);
            exit();
        }

        // Añadimos la parte de imagen al UPDATE.
        $update_image = ", image_path = '$image_path'";
    }

    // Preparamos la consulta SQL (con o sin imagen).
    $sql = "UPDATE 006_videogames 
            SET category_id = '$category_id',
                platform_id = '$platform_id',
                title = '$title', 
                description = '$description'
                $update_image,
                release_date = '$release_date', 
                price = '$price', 
                stock = '$stock'
            WHERE videogame_id = $videogame_id";

    // Estructura de control 'if'.
    // Comprobamos si la consulta se ejecutó correctamente.
    if (mysqli_query($conn, $sql)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }

    mysqli_close($conn);
    exit();
?>